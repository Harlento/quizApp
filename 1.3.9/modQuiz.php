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
            <form>
                <?php
                    $question = 0;

                    //
                    foreach($result as $key => $value)
                    {
                        if($question < 1)
                        {
                            print("
                                <br />
                                <h1>Quiz name: " . $value . "</h1>
                            ");
                            $question++;
                        }
                        else if($key[0] == 'q')
                        {
                            print("
                                <br />
                                Question " . $question . ": 
                                <input type='text' name='" . $key . "' 
                                value='" . $value . "'>
                                <br /><br />
                            ");
                            $question++;
                        }
                        else
                        {
                            print("
                                Answer: 
                                <input type='text' name='" . $key . "' 
                                value='" . $value . "'>
                                <br /><br />
                            ");
                        }
                    }
                ?>
            </form>
            <button>

            </button>
        </div>
    </body>
</html>