<?php
    include './includes/functions/connectDatabase.php';
    // Start the session
    session_start();

    // connect to the database
    $conn = connectDatabase();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <?php
            include './includes/headLinks.php';
            include './includes/functions/printQuiz.php';
        ?>
    </head>

    <body>
        <?php
            include './includes/navbar.php';

            // test
            /*
            echo '<pre>';
            print_r($_POST);
            print('</pre>');
            */
        ?>

        <div class='container rounded border border-primary shadow w-75'>
            <h1>Questions List</h1>

            <br /><br />

            <form action="/results.php" method="post" autocomplete="off">
                <?php
                    // test
                    //$dbArray;

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
                    /*
                    print('<pre>');
                    print_r($_POST);
                    print('</pre>');
                    */

                    // test
                    //print_r($_POST);

                    // test
                    //print_r($_SESSION);
                    //printf('<br />' . $_SESSION['POST']['3']);
                    
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
    </body>
</html>