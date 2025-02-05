$(document).ready(function() {
    $('#currencySelect').on('change', function() {
        var selectedCurrency = $(this).val();
        var currencySymbol = selectedCurrency === 'PHP' ? '₱' : selectedCurrency === 'USD' ? '$' : '€';
        let curr = $('#curr');
        let fee = $('#fee');
       

        $.ajax({
            url: dashboardRoute,
            method: 'GET',
            data: { currency: selectedCurrency },
            success: function(response) {
               
                 
                $('#hidden_val').val(response.walletBalance.balance);
                $('#wallet-balance').text(currencySymbol + ' ' + response.walletBalance.balance);
                $('#currencySelect').val(selectedCurrency);
                curr ? curr.text(selectedCurrency) :'';

                //Fee Base on Selected Currency
                fee.val(response.fee);
               
                 
            },
            error: function() {
                alert('Error fetching balance');
            }
        });
    });

    $(document).on('click','#dash-send-btn',function(e){
        e.preventDefault();

        $('.sendOptionModal').modal('show');

    });
    $('#xpress-btn').click(function(e){
        e.preventDefault();

        window.location.href='/Xpress-Send';
        
    });

    $('#bank-x-btn').click(function(e){
        e.preventDefault();
        window.location.href= bankOptionUrl;

    });
});

