jQuery(document).ready(function($) {
    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'];

    var i;
    for (i = new Date().getFullYear() - 16; i > 1970; i--) {
        $('.year').append($('<option />').val(i).html(i));
    }

    for ( i = 1; i < 13; i++){
        $('.month').append($('<option />').val(i).html(monthNames[i-1]));
    }
    updateNumberOfDays();
    $('.selectpicker').selectpicker({
        style: 'btn-default'
    });

});

function updateNumberOfDays(){
    var month = $('.month').val();
    var year = $('.year').val();
    var day = daysInMonth(month, year);

    for(i=1; i < day+1 ; i++){
        $('.day').append($('<option />').val(i).html(i));
    }
}

function daysInMonth(month,year){
    return new Date(year, month, 0).getDate();
}