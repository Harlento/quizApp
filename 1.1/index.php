<!DOCTYPE html>

<html>

    <head>
        <title>Language Quiz</title>
        <?php
          include './includes/headLinks.php';
        ?>
    </head>

    <body>
      <?php
        include './includes/navbar.php';
      ?>

      <div class='container rounded border border-primary shadow w-50'>
        <h1>Make a language vocabulary quiz.</h1>
        <br /><br />

        <form id="dynamicForm" action="/newQuiz.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <button type="button" class="btn btn-primary" id="spawnButton">
                New question
              </button>
              <br /><br />

              <h3>Quiz Name </h3>
              <input type='text' class="form-control" name='QuizName'>
              <br /><br />

              <input type="submit" class="btn btn-primary" value="Submit">
              <br /><br />
            </form>

            <form id="oldQuizForm" action="/oldQuiz.php" method="post">
              <h3>Stored quizes</h3>

              <input type="submit" class="btn btn-primary" value="Go to stored quizes">
              <br /><br />

            </div>
          </div>
        </form>
      </div>
      <h1 id="test"></h1>
    </body>

</html>