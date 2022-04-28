$(function() {
  $('.password-group').find('.password-box').each(function(index, input) {
      var $input = $(input);
      $input.parent().find('.password-visibility').click(function() {
          var change = "";
          if ($(this).find('i').hasClass('fa-pencil')) {
              $(this).find('i').removeClass('fa-pencil')
              $(this).find('i').addClass('fa-floppy-o')
              change = "text";
          } else {
              $(this).find('i').removeClass('fa-floppy-o')
              $(this).find('i').addClass('fa-pencil')
              change = "password";
          }
          var rep = $("<input type='" + change + "' />")
              .attr('id', $input.attr('id'))
              .attr('name', $input.attr('name'))
              .attr('class', $input.attr('class'))
              .val($input.val())
              .insertBefore($input);
          $input.remove();
          $input = rep;
      }).insertAfter($input);
  });
});