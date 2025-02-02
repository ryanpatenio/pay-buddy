$(document).ready(function() {
    $('#currencySelect').on('change', function() {
        var selectedCurrency = $(this).val();
        var currencySymbol = selectedCurrency === 'PHP' ? '₱' : selectedCurrency === 'USD' ? '$' : '€';
        let curr = $('#curr');
       

        $.ajax({
            url: dashboardRoute,
            method: 'GET',
            data: { currency: selectedCurrency },
            success: function(response) {
               
                 
                $('#hidden_val').val(response.walletBalance);
                $('#wallet-balance').text(currencySymbol + ' ' + response.walletBalance);
                $('#currencySelect').val(selectedCurrency);
                curr ? curr.text(selectedCurrency) :'';
               
                 
            },
            error: function() {
                alert('Error fetching balance');
            }
        });
    });
});

