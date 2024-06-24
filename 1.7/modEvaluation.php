<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Quiz</title>
        <?php
            include "includes/headLinks.php";
            include "./includes/functions/connectDatabase.php";
        ?>
    </head>
    <body>
        <?php
            $result = array();

            $conn = connectDatabase();

            $stmt = $conn->prepare("SELECT * FROM Quiz WHERE NAME=?");

            $params = array($_POST['quizMod']);
        
            $stmt->execute($params);

            // close database connection
            $conn = null;

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = unserialize($result[0]['Q_AND_A']);

            include "./includes/navbar.php";
        ?>

        <div class="container rounded border border-primary shadow w-75"
        style="min-height: 100%;">
            <?php
                $question = 0;

                // this prints out the original form
                print($result['formHtml'] . '<br /><br />');
            ?>
            <script>
                $('#formHtml').attr('value', $result['formHtml']);
            </script>
            <button type="submit" form="dynamicForm" 
            onclick="sendFormElements()" class="btn btn-primary">
                Submit
            </button>
            <br /><br />
        </div>
        <?php
            //
            include './includes/bottomLink.php';
        ?>
    </body>
</html>