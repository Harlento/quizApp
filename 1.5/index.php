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

    <body id="bodyElement">
      <?php
        include './includes/navbar.php';
      ?>

      <div id="bodyDiv" class="container-xl rounded border border-primary shadow w-75"
      style="min-height: 100%;">

        <form id="oldQuizForm" action="/oldQuiz.php" method="post">
          <br />
          <h3>Stored quizes</h3>

          <input type="submit" class="btn btn-primary" value="Go to stored quizes">
          <br /><br />
        </form>

        <h1>Quiz creation form.</h1>

        <form id="dynamicForm" action="/newQuiz.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              
              <br /><br />

              <h3>Quiz Name </h3>
              <input type="text" id="formHtml" name="formHtml" value="" hidden>
              <input type="text" id="quizName" oninput="updateValue(this)" 
              onclick="moveCursorToEnd()" class="form-control" name="QuizName" value="">
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
          This will only allow you to add 200 questions
          <input id="questionBatchInput" type="number" name="questionNumber" 
          value="" oninput="forceNumberRange()">

          <button type="button" class="btn btn-primary" id="quickCreateButton" 
          onclick="batchAddQuestions()">
            Print questions
          </button>

        </form>
        <br />

        <button type="submit" class="btn btn-primary" id="dynamicFormSubmit" 
        onclick="sendFormElements()" form="dynamicForm">
          Make quiz
        </button>
        <br /><br />
      </div>
      
      <a style="text-decoration: none;" class="linkHover bottomLink" href="#top" aria-label="Back to top">
        <div class="d-flex p-2 justify-content-center bg-primary text-white">
          <span class="text">Back to top</span>
        </div>
      </a>
    </body>
</html>

<!--  Upward facing chevron

<svg xmlns="http://www.w3.org/2000/svg"
     width="39px" height="25px"
     viewBox="0 0 1134 715">
  <path id="Unnamed"
        fill="black" stroke="black" stroke-width="1"
        d="M 567.35,52.36
           C 567.35,52.36 51.86,567.85 51.86,567.85
             51.86,567.85 148.04,664.03 148.04,664.03
             148.04,664.03 568.06,244.00 568.06,244.00
             568.06,244.00 986.67,662.61 986.67,662.61
             986.67,662.61 1082.14,567.14 1082.14,567.14
             1082.14,567.14 567.35,52.36 567.35,52.36 Z" />
</svg>

-->

<!--

  <svg xmlns="http://www.w3.org/2000/svg"
      width="3.78in" height="2.38333in"
      viewBox="0 0 1134 715">
    <path id="Unnamed"
          fill="none" stroke="black" stroke-width="1"
          d="M 566.65,664.64
            C 566.65,664.64 1082.14,149.15 1082.14,149.15
              1082.14,149.15 985.96,52.97 985.96,52.97
              985.96,52.97 565.94,473.00 565.94,473.00
              565.94,473.00 147.33,54.39 147.33,54.39
              147.33,54.39 51.86,149.86 51.86,149.86
              51.86,149.86 566.65,664.64 566.65,664.64 Z" />
  </svg>

-->