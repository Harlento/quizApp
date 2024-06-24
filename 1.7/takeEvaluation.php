<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <?php
            include 'includes/headLinks.php';
            include './includes/functions/printQuiz.php';
            include './includes/functions/connectDatabase.php';
        ?>
    </head>

    <body>
        <?php
            include './includes/navbar.php';
        ?>

        <div class="container rounded border border-primary shadow w-75"
        style="min-height: 100%;">
            <h1>Questions List</h1>

            <form action="/results.php" method="post" autocomplete="off">
                <div class="form-row">
                    <?php
                        // Variable that will recieve the question and answer array
                        $dbArray;

                        // connecting to the database
                        $conn = connectDatabase();

                        // Send the array to the database
                        // prepare sql and bind parameters
                        try 
                        {
                            // When a take quiz button is pressed print out that quiz ////////////////////////////
                            if(isset($_POST['takeEvaluation']))
                            {

                                $stmt = $conn->prepare("SELECT * FROM Quiz
                                WHERE NAME=?");

                                $params = array($_POST['takeEvaluation']);

                                $stmt->execute($params);

                                // close database connection
                                $conn = null;

                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                $qArray = array();

                                $result[0]['Q_AND_A'] = unserialize($result[0]['Q_AND_A']);

                                $_SESSION['POST'] = $result[0]['Q_AND_A'];
                                
                                printQuiz($_SESSION['POST']);
                            }
                            /////////////////////////////////////////////////////////////////////////////////////////
                        } 
                        catch(PDOException $e) 
                        {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>

                    <input type="submit" class="btn btn-primary" value="Submit Answers">
                </form>
                <br /><br />

            </div>
        </div>
        <?php
            // 
            include './includes/bottomLink.php';
        ?>
    </body>
</html>