$(function() {
    $('.expand').find('.test').each(function(index, input) {
        var $input = $(input);
        var m = document.getElementById("inputMeal");
        var w = document.getElementById("inputWeight");
        $input.parent().find('.enterData').click(function() {
            if ($(this).find('i').hasClass('fa-circle-plus')) {
                $(this).find('i').removeClass('fa-circle-plus')
                $(this).find('i').addClass('fa-circle-xmark');
            } else {
                $(this).find('i').removeClass('fa-circle-xmark')
                $(this).find('i').addClass('fa-circle-plus');
                m.style.display = "none";
                w.style.display = "none";
            }
            $input.remove();
            $input = rep;
        }).insertAfter($input);
    });
});
