


$(document).ready(function(){

    fetchBalance();


    $('#xpressForm').submit(function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        let balance = $('#hidden_val').val()
        let amount = $('#amount-to-send').val();
        
        if(parseInt(balance) < parseInt(amount)){
          return   alert('Insufficient Balance');
        }
        // axios.post('/submit-web-route', Data)

        //     .then(response => {
        //         console.log('Form submitted successfully:', response.data);
        //         alert('Success!');
        //     })
        //     .catch(error => {
        //         console.error('An error occurred:', error);
        //         alert('Something went wrong!');
        //     });
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
            $('#account-name').val(response.data.data.user_name)
           
           
           
        } catch (error) {
            console.error('An error occurred:', error);
         
        }
    });

   
   async function fetchBalance() {
    try {
        const response = await axios.get("/user-wallet-balance");

        if (response.status === 200) {
            $('#wallet-balance').text(`₱ ${response.data}`);
            $('#hidden_val').val(response.data);
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
