<!DOCTYPE html>

<html>

    <head>
        <title>Language Quiz</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
        <script>
          // This will spawn two inputs on click of a button
          $(document).ready(function(){
            var qCount = 0;
            var count = -1;
            var count2 = 0;
            $('#spawnButton').click(function()
            {
              qCount++;
              count = count + 2;
              count2 = count2 + 2;

              var label1 = $('<label>').attr('for', 'input_' + count).text
              ('Question ' + qCount + ': ');
              var input1 = $('<input>').attr({
                type: 'text',
                name: count,
                id: 'input_' + count
              });
              var label2 = $('<label>').attr('for', 'input_' + count2).text
              ('Answer: ');
              var input2 = $('<input>').attr({
                type: 'text',
                name: count2,
                id: 'input_' + count2
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
        </script>
    </head>

    <body>
        <h1>Make a language vocabulary quiz.</h1>

        <form id="dynamicForm" action="/newQuiz.php" method="post">
          <button type="button" id="spawnButton">
            New question
          </button>
          <br /><br />

          <h3>Quiz Name: </h3>
          <input type='text' name='QuizName'>
          <br /><br />

          <input type="submit" value="Submit">
          <br /><br />
        </form>

        <form id="oldQuizForm" action="/oldQuiz.php" method="post">
          <h3>Stored quizes</h3>

          <input type="submit" value="Go to stored quizes">
          <br /><br />
        </form>
        
    </body>

</html>