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
    </head>

    <body>
        <h1>Quizes</h1>

        <a href="index.php"><h2>Home</h2></a>
        <br /><br />

        <?php
            // Variable that will recieve the question and answer array
            $dbArray;

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

                // When a take quiz button is pressed print out that quiz ////////////////////////////
                if(isset($_POST['takeQuiz']))
                {
                    // test
                    //print('Take quiz button was activated');

                    $qCount = 1;

                    $qArray = array();

                    // Putting the questions into an array while
                    // retaining the original key values to shuffle them for the
                    // user
                    foreach ($_POST as $key => $value) 
                    {  
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
                            . '<br /> <input type="text" name=' . $key . ' >
                            <br /><br />'
                        );
                        $qCount++;
                    }
                }
                /////////////////////////////////////////////////////////////////////////////////////////

                // printing out a button for each quiz stored in the database table
                foreach($result as $data)
                {
                    // test
                    //print('In foreach loop <br />');

                    printf('
                        <form id="form2" action="takeQuiz.php" method="post">
                            <input type="submit" name="takeQuiz" value="' . $data['NAME'] . '"> 
                            <br />
                        </form>
                        <br />
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
        ?>
    </body>
</html>