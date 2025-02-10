$(document).ready(function(){

    $('#currency').on('change', function() {
        var selectedCurrency = $(this).val();
        //var currencySymbol = selectedCurrency === 'PHP' ? '₱' : selectedCurrency === 'USD' ? '$' : '€';
       let earnings = $('#total-earnings');
       let todayEarnings = $('#today-earnings');
       let thisMonth = $('#monthly-earnings');

        $.ajax({
            url: '/Dashboard-admin',
            method: 'GET',
            data: { currency: selectedCurrency },
            success: function(response) {
              
                if (response.total_earnings) {
                    updateEarnings(earnings, response.total_earnings.total);
                    updateEarnings(todayEarnings, response.total_earnings.today);
                    updateEarnings(thisMonth, response.total_earnings.monthly);
                } else {
                    // Handle the case where total_earnings is null or undefined
                    $('#total, #today, #monthly').text('0');
                }
                 
            },
            error: function() {
                alert('Error fetching balance');
            }
        });
    });

});

function updateEarnings(selector, earningsData) {
    if (earningsData && earningsData.symbol && earningsData.total) {
        $(selector).text(earningsData.symbol + ' ' + earningsData.total);
    } else {
        $(selector).text('0');
    }
}