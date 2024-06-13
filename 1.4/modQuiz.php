<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Quiz</title>
        <?php
            include "includes/headLinks.php";
            include "./includes/functions/connectDatabase.php";
        ?>
    </head>
    <body>
        <?php
            $conn = connectDatabase();

            $stmt = $conn->prepare("SELECT * FROM Quiz WHERE NAME=?");

            $params = array($_POST['quizMod']);
        
            $stmt->execute($params);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = unserialize($result[0]['Q_AND_A']);

            include "./includes/navbar.php";
        ?>

        <div class="container rounded border border-primary shadow w-75">
            <?php
                $question = 0;

                // this prints out the original form
                print($result['formHtml'] . '<br /><br />');
                
                //print_r($result);
                //print('</pre>');
                //$slicedResult = array_slice($result, 1);

                // test
                //print_r($result);

                //$size = sizeof($result);

                //print("Size of the array: " . $size . "<br /><br />");

                //$jsonResult = json_encode($result);

                //print($jsonResult);
            ?>
            <script>
                // this will encode the form data into a json string
                //var qAndAArray = <?php //echo "'" . json_encode($slicedResult) . "'"; ?>;

                // this will fill the form with those values
                //fillQuizModForm(qAndAArray);

                $('#formHtml').attr('value', $result['formHtml']);
            </script>
            <button type="submit" form="dynamicForm" 
            onclick="sendFormElements()" class="btn btn-primary">
                Submit
            </button>
            <br /><br />
        </div>
        <br />
    </body>
</html>