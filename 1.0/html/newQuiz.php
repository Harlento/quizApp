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
        <h1>Questions List</h1>

        <a href="index.php"><h2>Home</h2></a>
        <br /><br />

        <form action="/results.php" method="post">
            <?php
                // test
                $dbArray;

                // Send the array to the database
                // prepare sql and bind parameters
                try 
                {
                    $stmt = $conn->prepare("INSERT INTO Quiz (Q_AND_A, NAME) 
                    VALUES (:Q_AND_A, :NAME)");
                    $stmt->bindParam(':Q_AND_A', $array);
                    $stmt->bindParam(':NAME', $name);

                    // insert a row
                    $array = serialize($_POST);
                    $name = $_POST['QuizName'];

                    $stmt->execute();

                    // test
                    //print("Statement just executed");
                } 
                catch(PDOException $e) 
                {
                    echo "Error: " . $e->getMessage();
                }

                // test
                //print("After execution");

                // Storing the post array in a session variable 
                $_SESSION['POST'] = $_POST;

                // test
                //print_r($_POST);

                // test
                //print_r($_SESSION);
                //printf('<br />' . $_SESSION['POST']['3']);
                
                // The new quiz being printed out to be taken
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    
                    $qCount = 1;

                    $qArray = array();

                    // Putting the questions into an array while
                    // retaining the original key values to shuffle them for the
                    // user
                    foreach ($_POST as $key => $value) 
                    {  
                        $key = (int) $key;

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
            ?>

            <input type="submit" value="Submit Answers">
        </form>
    </body>
</html>