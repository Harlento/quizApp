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
                try 
                {
                    $conn = connectDatabase();

                    $stmt = $conn->prepare("DELETE FROM Quiz WHERE NAME=?");

                    $params = array($_POST['quizDelete']);
                
                    $stmt->execute($params);

                    // close database connection
                    $conn = null;

                    header("Location: /oldQuiz.php");
                }
                catch(PDOException $e)
                {
                    echo "Error: " . $e->getMessage();
                }
            ?>
        </div>
    </body>
</html>