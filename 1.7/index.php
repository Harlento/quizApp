<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <title>Evaluation Creation</title>
        <?php
          include './includes/headLinks.php';
          include "./includes/functions/connectDatabase.php";
        ?>
    </head>

    <body id="bodyElement">
      <?php
        include './includes/navbar.php';
      ?>

      <div id="bodyDiv" class="container-xl rounded border border-primary shadow w-75"
      style="min-height: 100%;">

        <form id="evaluationsForm" action="/evaluations.php" method="post">
          <br />
          <h3>Stored Evaluations</h3>

          <input type="submit" class="btn btn-primary" value="Go to stored Evaluations">
          <br /><br />
        </form>

        <h1>Evaluation creation form.</h1>

        <form id="dynamicForm" action="/newEvaluation.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              
              <br /><br />

              <h3>Evaluation Name </h3>
              <input type="text" id="formHtml" name="formHtml" value="" hidden>
              <input type="text" id="evaluationName" oninput="updateValue(this)" 
              class="form-control" name="EvaluationName" value="">
              <br /><br />
              
            </div>
          </div>
        </form>
        <button type="button" class="btn btn-primary" id="spawnButton"
        onclick="addInputPair(); movePage();">
          New question
        </button>
        <br id="lineBreak2" /><br id="lineBreak3" />

        <?php
          // this means the user attempted to name the quiz the same as a quiz that already
          // exists
          if(isset($_REQUEST['uniqueName']))
          {
            $_SESSION['postedQuiz'];

            // 
            print('
              <script>
                $("#dynamicForm").remove();
                $("#spawnButton").remove();
                $("#lineBreak2").remove();
                $("#lineBreak3").remove();

                confirm("You must give a quiz a unique name to store it.");
              </script>
            ');

            print($_SESSION['postedQuiz']['formHtml'] . '<br /><br />');

            // change the action of the dynamicForm
            print('
              <script>
                changeFormAction();
                // Set a new URL
                var newUrl = "index.php";

                // Update the browser URL
                window.location.href = newUrl;
              </script>
            ');
          }

          // 
          if(isset($_REQUEST['blankName']))
          {
            $_SESSION['postedQuiz'];

            // 
            print('
              <script>
                $("#dynamicForm").remove();
                $("#spawnButton").remove();
                $("#lineBreak2").remove();
                $("#lineBreak3").remove();

                confirm("The name of the quiz must be provided for it to be stored.");
              </script>
            ');

            print($_SESSION['postedQuiz']['formHtml'] . '<br /><br />');

            // change the action of the dynamicForm
            print('
              <script>
                changeFormAction();
                // Set a new URL
                var newUrl = "index.php";

                // Update the browser URL
                window.location.href = newUrl;
              </script>
            ');
          }
        ?>

        <form id="quickCreate" action="/index.php" method="post">
          <h3>Provide desired number of questions here</h3>
          This will only allow you to add 200 questions at a time
          <input id="questionBatchInput" type="number" name="questionNumber" 
          value="" oninput="forceNumberRange()">

          <button type="button" class="btn btn-primary" id="quickCreateButton" 
          onclick="batchAddQuestions()">
            Print questions
          </button>

        </form>
        <br />

        <button type="submit" class="btn btn-primary" id="dynamicFormSubmit" 
        onclick="return checkForEmptyInputs();" form="dynamicForm">
          Make evaluation
        </button>
        <br /><br />
      </div>
      <?php
        // 
        include './includes/bottomLink.php';
      ?>
    </body>
</html>