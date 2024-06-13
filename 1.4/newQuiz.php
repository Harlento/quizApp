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
                // test
                //print('<pre>');
                //print_r($_POST);
                //print('</pre>');

                $checkstmt = $conn->prepare("SELECT * FROM Quiz WHERE NAME=?");
                
                $params = array($_POST['QuizName']);

                $checkstmt->execute($params);

                $result = $checkstmt->fetchAll(PDO::FETCH_ASSOC);

                // test
                //print('<pre>');
                //print_r($result);
                //print('</pre>');

                //print(sizeof($result));

                // this means that there is a quiz with that name already
                if(sizeof($result) > 0)
                {
                    print('There was a quiz with the same name');
                    //$result = unserialize($result[0]['Q_AND_A']);
                    //$_SESSION['postedQuiz'] = $_POST;

                    header("Location: /index.php?uniqueName=false");
                }

                // 
                if(sizeof($result) == 0)
                {
                    $stmt = $conn->prepare("INSERT INTO Quiz (Q_AND_A, NAME) 
                    VALUES (:Q_AND_A, :NAME)");
                    $stmt->bindParam(':Q_AND_A', $array);
                    $stmt->bindParam(':NAME', $name);

                    // insert a row
                    $array = serialize($_POST);
                    $name = $_POST['QuizName'];

                    $stmt->execute();
                }
                
                // test
                //print("Statement just executed");
            } 
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        ?>

        <div class='container rounded border border-primary shadow w-75'>
            <h1>Questions List</h1>

            <br /><br />

            <form action="/results.php" method="post" autocomplete="off">
                <?php
                    // test
                    //$dbArray;

                    

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
            <h1 id="test1"></h1>
            <h1 id="test2"></h1>
            <h1 id="test3"></h1>
            <h1 id="test4"></h1>
            <h1 id="test5"></h1>
            <h1 id="test6"></h1>
            <br />
        </div>
    </body>
</html>