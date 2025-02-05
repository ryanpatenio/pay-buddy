$(document).ready(function(){


    $('#selectedBank').click(function(e){
        e.preventDefault();

        let bankSelected = $(this).attr('data-id');

        window.location.href = '/Bank-Transfer-process?bankCode='+bankSelected;

    });
});