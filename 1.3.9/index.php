<!DOCTYPE html>

<html>

    <head>
        <title>Language Quiz</title>
        <?php
          include './includes/headLinks.php';
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
        <br />

        <form id="dynamicForm" action="/newQuiz.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              
              <br /><br />

              <h3>Quiz Name </h3>
              <input type='text' class="form-control" name='QuizName'>
              <br /><br />
              
            </div>
          </div>
          
        </form>
        <button type="button" class="btn btn-primary" id="spawnButton">
          New question
        </button>
        <br /><br />

        <button type="submit" class="btn btn-primary" id="dynamicFormSubmit" form="dynamicForm">
          Submit
        </button>
        <br /><br />
      </div>
      <h1 id="test1"></h1>
      <h1 id="test2"></h1>
      <h1 id="test3"></h1>
      <h1 id="test4"></h1>
      <h1 id="test5"></h1>
      <h1 id="test6"></h1>
    </body>

</html>