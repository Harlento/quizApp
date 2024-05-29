<?php
    // Start the session
    session_start();

    // connect to the database
    try 
    {
        $conn = new PDO("mysql:host=localhost;dbname=QuizDatabase", "root", "Chyuugokugo2");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully"; 
    } 
    catch(PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <?php
            include './includes/headLinks.php';
        ?>
    </head>

    <body>
        <?php
            include './includes/navbar.php';
        ?>

        <div class='container rounded border border-primary shadow w-50'>
            <h1>Questions List</h1>

            <form action="/results.php" method="post" autocomplete="off">
                <div class="form-row">
                    <?php
                        // Variable that will recieve the question and answer array
                        $dbArray;

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

                                $qCount = 1;

                                $qArray = array();

                                $result[0]['Q_AND_A'] = unserialize($result[0]['Q_AND_A']);

                                $_SESSION['POST'] = $result[0]['Q_AND_A']; 

                                // test
                                //print_r($result[0]['Q_AND_A']);
                                //print('<br />');

                                // Putting the questions into an array while
                                // retaining the original key values to shuffle them for the
                                // user
                                foreach ($result[0]['Q_AND_A'] as $key => $value) 
                                {  
                                    $key = (int) $key;
                                    //test 
                                    //print('Foreach loop');

                                    if($key % 2 == 1)
                                    {
                                        // Odd parity
                                        $qArray[$key] = $value;

                                        // test
                                        //print_r($qArray);
                                        //print('<br />');
                                    }
                                }

                                // Shuffle the question array to make the user print out less predictable
                                uasort($qArray, function($a, $b)
                                {
                                    return rand(-1, 1);
                                });

                                // Printing out the questions for the user to answer
                                foreach($qArray as $key => $value)
                                {
                                    // User print out
                                    printf('Question ' . $qCount . ': ' . $value
                                        . '<br /> <input type="text" class="form-control w-25" name=' . $key . ' >
                                        <br /><br />'
                                    );
                                    $qCount++;
                                }
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
            </div>
        </div>
    </body>
</html>