<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <title>Language Quiz</title>
        <?php
          include './includes/headLinks.php';
          include "./includes/functions/connectDatabase.php";
        ?>
    </head>

    <body id='bodyElement'>
      <?php
        include './includes/navbar.php';
      ?>

      <div id='bodyDiv' class='container-xl rounded border border-primary shadow w-75'>

        <form id="oldQuizForm" action="/oldQuiz.php" method="post">
          <br />
          <h3>Stored quizes</h3>

          <input type="submit" class="btn btn-primary" value="Go to stored quizes">
          <br /><br />
        </form>

        <h1>Make a language vocabulary quiz.</h1>
        <br id="lineBreak1" />

        <form id="dynamicForm" action="/newQuiz.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              
              <br /><br />

              <h3>Quiz Name </h3>
              <input type="text" id="formHtml" name="formHtml" value="" hidden>
              <input type="text" id="quizName" oninput="updateValue(this)" 
              class="form-control" name="QuizName" value="">
              <br /><br />
              
            </div>
          </div>
        </form>
        <button type="button" class="btn btn-primary" id="spawnButton">
          New question
        </button>
        <br id="lineBreak2" /><br id="lineBreak3" />

        <?php
          // this means the user attempted to name the quiz the same as a quiz that already
          // exists
          if(isset($_REQUEST['uniqueName']))
          {
            $_SESSION['postedQuiz'];

            // test
            //print('<pre>');
            //print_r($_SESSION['postedQuiz']);

            print('
              <script>
                $("#dynamicForm").remove();
                $("#spawnButton").remove();
                $("#lineBreak1").remove();
                $("#lineBreak2").remove();
                $("#lineBreak3").remove();

                confirm("You must give a quiz a unique name to store it.");
              </script>
            ');

            print($_SESSION['postedQuiz']['formHtml'] . '<br /><br />');
          }
        ?>

        <button type="submit" class="btn btn-primary" id="dynamicFormSubmit" 
        onclick="sendFormElements()" form="dynamicForm">
          Submit
        </button>
        <br /><br />
      </div>
    </body>
</html>