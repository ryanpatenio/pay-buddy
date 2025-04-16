
$(document).ready(function(){

    fetchBalance();


    $('#xpressForm').submit( async function(e){
        e.preventDefault();

        let account = $('#account-number').val().trim();      
        let balance = $('#hidden_val').val()
        let amount = $('#amount-to-send').val();
        let currency = $('#currencySelect').val();
        let account_name = $('#account-name').val();

        let fee = $('#fee').val();

        let total = parseFloat(amount)+parseFloat(fee);

        
        if(parseInt(balance) < parseInt(amount)){
          return   alert('Insufficient Balance');
        }

        const data = {
            account_number: account, // Ensure this is a string if it has leading zeros
            amount: parseFloat(amount), // Convert amount to a proper number
            currency: currency.trim(), // Trim whitespace for validation
            account_name: account_name,
            fee : fee
        };
        
        swalMessage('custom',
            'You are about to send '+currency+' '+amount+' to '+account_name+' (Account: '+account+'). A transaction fee of '+currency+' '+fee+' will be applied. Your total deduction will be '+currency+' '+total+'. Do you want to proceed?', 
            async function () { 
                try {
                    toggleLoader(true);

                    const checkAccount = await axios.post('/checkAccount', { account_number: account });
                    if (checkAccount.status !== 200) {
                        return msg('Account cannot be found!','info');
                    }
        
                    const sendTransaction = await axios.post('/process-transaction', data);
                    if (sendTransaction.status !== 200) {
                        return msg('Cannot process Transaction!','error');
                    }

                    resetForm($('#xpressForm'));

                    // Redirect user to receipt page
                    const transactionId = sendTransaction.data.transaction_id;
                    //console.log(sendTransaction)

                    msg(sendTransaction.data.message,'success');
                   

                    setTimeout(() => {
                        window.location.href = `/Xpress-Receipt?transaction_id=${transactionId}`;
                    }, 2000);
               
                } catch (error) {    
                    res(error)            
                    const {response} = error;
                    const err = response?.data;
                              
                    if (response?.status === 422 || err?.code === 'EXIT_FORM_NULL') {                       
                        msg(err?.message || "Account Number not found!",'info');
                    }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                        msg(err?.code || err?.error || 'Wallet not found or Account Number','error');
                    }else{
                        msg('Server Error!','error');
                    }
        
                }finally{
                    toggleLoader(false);
                }
            }
        );

       
    });
    
    

    $(document).on('input', '#account-number', async function (e) {
        let account = $(this).val().trim();
        
        if (account.length !== 11) return $('#acct-error').text('');  $('#account-name-2').val("") // Only trigger when length is exactly 11
    
        try {
            const response = await axios.post('/checkAccount', { account_number: account });

            if(response.data.message == "Invalid-acct"){
               return $('#acct-error').text('Account cannot be found!')
            }
            $('#acct-error').text('')
            $('#account-name').val(response?.data?.data?.user_name);

        } catch (error) {
            console.error('An error occurred:', error);
            const {response} = error;
            const err = response?.data;
            if(response.status === 422 || err?.code === "EXIT_FORM_NULL"){
                res('Account number not found');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg('Internal Server Error!','error');
            }else{
                msg('Internal Server Error!','error');
            }
        }
    });

   
   async function fetchBalance() {
    try {
        const response = await axios.get("/user-wallet-balance");

        if (response.status === 200) {
          
            $('#wallet-balance').text(`₱ ${response?.data?.balance ?? 0}`);
            $('#hidden_val').val(response?.data?.balance ?? 0);
        }
    } catch (error) {
        console.error("Failed to fetch wallet balance:", error.response ? error.response.data : error);
    }
}



});

//sample of async and await
// async function fetchUserData() {
//     try {
//         // Step 1: Fetch user details
//         const userDetailsResponse = await axios.get('/user/details');
        
//         if (userDetailsResponse.status !== 200) {
//             throw new Error("Failed to fetch user details.");
//         }
        
//         const userDetails = userDetailsResponse.data;
//         console.log("User Details:", userDetails);

//         // Step 2: Fetch wallet balance
//         const walletBalanceResponse = await axios.get('/user/wallet-balance');
        
//         if (walletBalanceResponse.status !== 200) {
//             throw new Error("Failed to fetch wallet balance.");
//         }
        
//         const walletBalance = walletBalanceResponse.data;
//         console.log("Wallet Balance:", walletBalance);

//         // Step 3: Check if wallet balance is below threshold
//         const balanceThreshold = 1000;
//         if (walletBalance < balanceThreshold) {
//             console.log("Balance is below threshold. Adding funds...");

//             // Step 4: Add funds if balance is below threshold
//             const addFundsResponse = await axios.post('/user/add-funds', {
//                 amount: 500 // Adding 500 to the wallet
//             });

//             if (addFundsResponse.status === 200) {
//                 console.log("Funds added successfully.");
//                 // You can update the UI or take action based on this response
//             } else {
//                 throw new Error("Failed to add funds.");
//             }
//         } else {
//             console.log("Balance is sufficient.");
//         }

//     } catch (error) {
//         console.error("Error:", error.message);
//     }
// }

// // Call the function
// fetchUserData();

 // axios.post('/submit-web-route', Data)

        //     .then(response => {
        //         console.log('Form submitted successfully:', response.data);
        //         alert('Success!');
        //     })
        //     .catch(error => {
        //         console.error('An error occurred:', error);
        //         alert('Something went wrong!');
        //     });