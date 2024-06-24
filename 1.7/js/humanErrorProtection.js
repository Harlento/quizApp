// This will prevent the enter button from submitting the forms
$(document).ready(function() {
    $('form').on('keypress',
    function(event) {
      if(event.keyCode === 13) {
        event.preventDefault();
      }
    });
  });
//////////////////////////////////////////////////////////////////////////