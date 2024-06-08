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
        ?>
        <div class='container rounded border border-primary shadow w-75'>
            <div class='container'>
                <h1>Quizes</h1>
            </div>
            
            <br /><br />

            <?php
                // Variable that will recieve the question and answer array
                $dbArray;

                // connect to the database
                $conn = connectDatabase();

                // Send the array to the database
                // prepare sql and bind parameters
                try 
                {
                    // test
                    //print('Try block <br />');

                    $selectStatement = $conn->prepare("SELECT NAME, Q_AND_A FROM
                    Quiz");

                    $selectStatement->execute();

                    // test
                    //print('After selection statement execution <br />');

                    $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);

                    // closing the connection
                    $conn = null;

                    // test
                    //print('After fetchAll <br />');

                    // printing out a button for each quiz stored in the database table
                    foreach($result as $data)
                    {
                        // test
                        //print('In foreach loop <br />');

                        printf('
                            <form id="form2" action="takeQuiz.php" method="post">
                                <input type="submit" class="btn btn-primary" 
                                name="takeQuiz" value="' . $data['NAME'] . '"> 
                                <br />
                            </form>

                            <form id="mod' . $data['NAME'] . '" action="modQuiz.php" method="post">
                                <input hidden name="quizMod" value="' . $data['NAME'] . '">
                            </form>

                            <form id="delete' . $data['NAME'] . '" 
                            action="deleteQuiz.php" method="post" onsubmit="return interceptDelete()">
                                <input hidden name="quizDelete" value="' . $data['NAME'] . '">
                            </form>
                            

                            <button type="submit" form="mod' . $data['NAME'] . '" 
                            class="btn btn-warning">
                                Modify
                            </button>

                            <button type="submit" form="delete' . $data['NAME'] . '"
                            class="btn btn-danger">
                                Delete
                            </button>
                            <br /><br />
                        ');

                        // test
                        //print($data['Q_AND_A']);
                        //$dbArray = unserialize($data['Q_AND_A']);
                    }

                    // test
                    //print_r($dbArray);
                } 
                catch(PDOException $e) 
                {
                    echo "Error: " . $e->getMessage();
                }

                // test
                //print_r($_SESSION);
                //printf('<br />' . $_SESSION['POST']['3']);
                //print($_SERVER['PHP_SELF']);
            ?>
        </div>
    </body>
</html>