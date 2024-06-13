<?php
    // Start the session
    session_start();
    include "./includes/functions/connectDatabase.php";
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <div>
            <?php
                $conn = connectDatabase();

                $stmt = $conn->prepare("DELETE FROM Quiz WHERE NAME=?");

                $params = array($_POST['quizDelete']);
            
                $stmt->execute($params);

                header("Location: /oldQuiz.php");
            ?>
        </div>
    </body>
</html>