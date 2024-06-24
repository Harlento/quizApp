<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <?php
            include './includes/headLinks.php';
            include './includes/functions/printQuiz.php';
            include './includes/functions/connectDatabase.php';
        ?>
    </head>

    <body>
        <?php
            include './includes/navbar.php';
            // connect to the database
            $conn = connectDatabase();

            // Send the array to the database
            // prepare sql and bind parameters
            try 
            {

                $checkstmt = $conn->prepare("SELECT * FROM Quiz WHERE NAME=?");
                
                $params = array($_POST['EvaluationName']);

                $checkstmt->execute($params);

                $result = $checkstmt->fetchAll(PDO::FETCH_ASSOC);

                // this means that there is a quiz with that name already
                if(sizeof($result) > 0)
                {
                    // 
                    $_SESSION['postedQuiz'] = $_POST;

                    // close database connection
                    $conn = null;

                    header("Location: /index.php?uniqueName=false");
                }

                // 
                if((sizeof($result) == 0) && ($_POST['EvaluationName'] != ""))
                {
                    // 
                    $stmt = $conn->prepare("INSERT INTO Quiz (Q_AND_A, NAME) 
                    VALUES (:Q_AND_A, :NAME)");
                    $stmt->bindParam(':Q_AND_A', $array);
                    $stmt->bindParam(':NAME', $name);

                    // insert a row
                    $array = serialize($_POST);
                    $name = $_POST['EvaluationName'];

                    $stmt->execute();

                    // close database connection
                    $conn = null;
                }
                else
                {
                    // 
                    $_SESSION['postedQuiz'] = $_POST;

                    // close database connection
                    $conn = null;

                    header("Location: /index.php?blankName=true");
                }
            } 
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        ?>

        <div class="container rounded border border-primary shadow w-75"
        style="min-height: 100%;">
            <h1>Questions List</h1>

            <br /><br />

            <form action="/results.php" method="post" autocomplete="off">
                <?php
                    // Storing the post array in a session variable 
                    $_SESSION['POST'] = $_POST;
                    
                    // The new quiz being printed out to be taken
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        printQuiz($_POST);
                    }
                ?>

                <input type="submit" class="btn btn-primary" value="Submit Answers">
            </form>
            <br />
        </div>
        <?php
            // 
            include './includes/bottomLink.php';
        ?>
    </body>
</html>