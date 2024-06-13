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
            $conn = connectDatabase();

            try 
            {
                // this will delete the original version of the quiz
                $deleteStmt = $conn->prepare("DELETE FROM Quiz WHERE NAME=?");

                $params = array($_POST['QuizName']);

                $deleteStmt->execute($params);

                // this will insert the quiz with the new values into the table
                $stmt = $conn->prepare("INSERT INTO Quiz (Q_AND_A, NAME) 
                VALUES (:Q_AND_A, :NAME)");
                $stmt->bindParam(':Q_AND_A', $array);
                $stmt->bindParam(':NAME', $name);

                $name = $_POST['QuizName'];
                $array = serialize($_POST);

                // test
                //print('<pre>');
                //print_r($_POST);
                //print('</pre>');

                $stmt->execute();
            } 
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }

            header("Location: /oldQuiz.php");
        ?>
    </body>
</html>