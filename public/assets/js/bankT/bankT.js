$(document).ready(function(){
    //Fetch Bank Selected
    fetchBankSelected();

    $('#bank-transfer-form').submit(async function(e){
        e.preventDefault();

        const urlParams = new URLSearchParams(window.location.search);
        const bankName = urlParams.get('bankCode');

        const balance = $('#hidden-balance').val();

        const amount = $('#amount-to-send').val();
        const account_number = $('#account-number').val();
        const account_name = $('#account-name').val();
        const fee = $('#transaction-fee').val();

        
        if(parseInt(amount) > parseInt(balance)){
            msg('Insufficient Balance','info');           
            return;
        }
        let total = parseFloat(amount) + parseFloat(fee);

        const data = {
            account_number : account_number,
            account_name : account_name,
            amount : parseFloat(amount),
            fee : parseFloat(fee),
            bankName : bankName
        };  
        
        swalMessage('custom',
            'You are about to send PHP '+amount+' to '+account_name+' (Account: '+account_number+'). A transaction fee of PHP '+fee+' will be applied. Your total deduction will be PHP '+total+'. Do you want to proceed?', async function(){

                try {

                    // const processTransaction = await axios.post('/process-bank-transfer',data);
                    // if(processTransaction.status !== 200){
                    //     console.log('failed to process Bank Transfer!');
                    // }
        
                    // console.log(processTransaction);
                    msg('Bank Transfer Features are not available at this time Due to Update!')
                    
                } catch (error) {
                    console.log(error)
                }

            });


    });


    async function fetchBankSelected() {
        const urlParams = new URLSearchParams(window.location.search);
        const bankName = urlParams.get('bankCode');
    
        if (!bankName) {
            console.error('Bank code not found in URL');
            return window.location.href='/Bank-Transfer';
        }
    
        try {
            const response = await axios.post('/get-user-selected-balance', { bankName: bankName });
            const imgUrl = response.data.data.img_url;
    
            // Construct the full image URL
            const fullImgUrl = `assets/img/bank_img/${imgUrl}`;
    
            // Update the image source
            $('#bank-img')
                .attr('src', fullImgUrl)
                .on('error', function() {
                    // Handle image loading error
                    $(this).attr('src', 'assets/img/default-bank.png'); // Fallback image
                    console.error('Failed to load image:', fullImgUrl);
                })
                .show(); // Ensure the image is visible
                
            $('#bank-description').text(response.data.data.description);
            //console.log('Bank image updated successfully:', response.data);
    
        } catch (error) {
            
            let err_response = error.response?.data;
            if (error.response?.status === 422 || err_response?.code === 'EXIT_FORM_NULL') {              
               alert(err_response.message)
                window.location.href='/Bank-Transfer';
                 return;
            }

            // Set a fallback image in case of an error
            $('#bank-img')
                .attr('src', 'assets/img/default-bank.png') // Fallback image
                .show();
        }
    }


});