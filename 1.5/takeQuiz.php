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
        style="min-height: 80%;">
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
                            // test
                            //print('Try block <br />');

                            // test
                            //print('After fetchAll <br />');

                            // When a take quiz button is pressed print out that quiz ////////////////////////////
                            if(isset($_POST['takeQuiz']))
                            {
                                // test
                                //print($_POST['takeQuiz']);
                                //$_SESSION['POST'] = $_POST;

                                $stmt = $conn->prepare("SELECT * FROM Quiz
                                WHERE NAME=?");

                                //test
                                //print($_POST['takeQuiz']);

                                $params = array($_POST['takeQuiz']);
                                
                                // test //////////////////////////////////////////////////////////////////////////////
                                //print_r($params);

                                // test
                                //print_r($params);
                                //print('<br />');

                                $stmt->execute($params);

                                // test
                                //print('After selection statement execution <br />');

                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // test //////////////////////////////////////////////////////////////////////////////
                                //print_r($result);
                                //print_r($result[0]['Q_AND_A']);
                                //print('<br />');

                                //$qCount = 1;

                                $qArray = array();

                                $result[0]['Q_AND_A'] = unserialize($result[0]['Q_AND_A']);

                                $_SESSION['POST'] = $result[0]['Q_AND_A'];

                                // test
                                //print('<pre>');
                                //print_r($_SESSION['POST']);
                                //print('</pre>');
                                
                                printQuiz($_SESSION['POST']);

                                // test
                                //print_r($result[0]['Q_AND_A']);
                                //print('<br />');
                            }
                            /////////////////////////////////////////////////////////////////////////////////////////
                        } 
                        catch(PDOException $e) 
                        {
                            echo "Error: " . $e->getMessage();
                        }

                        // test
                        //print_r($_SESSION);
                        //printf('<br />' . $_SESSION['POST']['3']);
                    ?>

                    <input type="submit" class="btn btn-primary" value="Submit Answers">
                </form>
                <br /><br />

            </div>
        </div>
        
        <a style="text-decoration: none;" class="linkHover bottomLink" href="#top" aria-label="Back to top">
            <div class="d-flex p-2 justify-content-center bg-primary text-white">
                <span class="text">Back to top</span>
            </div>
        </a>
    </body>
</html>