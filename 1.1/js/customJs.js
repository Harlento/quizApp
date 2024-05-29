// This will spawn two inputs on click of a button
/*
$(document).ready(function(){
    var qCount = 0;
    var count = -1;
    var count2 = 0;
    $('#spawnButton').click(function()
    {
      qCount++;
      count = count + 2;
      count2 = count2 + 2;

      var label1 = $('<label>').attr('for', 'q' + count).text
      ('Question ' + qCount + ': ');
      var input1 = $('<input>').attr({
        type: 'text',
        name: count,
        id: 'q' + count
      });
      var label2 = $('<label>').attr('for', 'a' + count2).text
      ('Answer: ');
      var input2 = $('<input>').attr({
        type: 'text',
        name: count2,
        id: 'a' + count2
      });
      var lineBreak = '<br />';

      $('#dynamicForm').append(label1, input1, lineBreak,
       label2, input2, lineBreak, lineBreak);
    });
  });
  
  // This will prevent the enter button from submitting the forms
  $(document).ready(function() {
    $('form').on('keypress',
    function(event) {
      if(event.keyCode === 13) {
        event.preventDefault();
      }
    });
  });
  */