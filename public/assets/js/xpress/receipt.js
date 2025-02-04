// const transaction = JSON.parse(localStorage.getItem('transaction'));
// console.log(transaction)

// if(transaction){
//     $('#transaction-type').text(transaction.transaction_type);
//     $('#sent-to').text(transaction.sent_to);
//     $('#account-number').text(transaction.account_number);
//     $('#transaction-date').text(transaction.trans_date);
//     $('#transaction-code').text(transaction.trans_code)
//     $('#total-amount').text(transaction.total_amount)
//     $('#currency').text(transaction.currency);

//     let responseStatus = transaction.status;
//     let statusClass = responseStatus === "success" ? "text-bg-success-soft" :
//                       responseStatus === "pending" ? "text-bg-warning-soft" :
//                       "text-bg-danger-soft";
    
//     $('#status').addClass(statusClass);
 
// }

$(document).ready( async function(){

    const urlParams = new URLSearchParams(window.location.search);
    const transactionId = urlParams.get('transaction_id');

    if (!transactionId) {
        alert("No transaction found!");
        return;
    }

    try {
        const response = await axios.get(`/get-transaction/${transactionId}`);
        if (response.status === 200) {
            const transaction = response.data;
            displayReceipt(transaction); // Function to update the UI
        }
    } catch (error) {
        console.error("Error fetching transaction:", error);
        alert("Failed to load transaction details.");
    }

});


// Function to update the receipt page UI
function displayReceipt(transaction) {

    $('#transaction-type').text(transaction.transaction_type);
    $('#sent-to').text(transaction.name);
    $('#account-number').text(transaction.account_number);
    $('#transaction-date').text(transaction.transaction_date);
    $('#transaction-code').text(transaction.transaction_id)
    $('#total-amount').text(transaction.amount)
    $('#currency').text(transaction.code);


    let responseStatus = transaction.status;
        let statusClass = responseStatus === "success" ? "text-bg-success-soft" :
                          responseStatus === "pending" ? "text-bg-warning-soft" :
                          "text-bg-danger-soft";
        
     $('#status').addClass(statusClass);
}



