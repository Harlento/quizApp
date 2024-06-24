<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Evaluation</title>
        <?php
            include './includes/headLinks.php';
            include './includes/functions/connectDatabase.php';
        ?>
    </head>

    <body>
        <?php
            include './includes/navbar.php';
        ?>
        <div class="container rounded border border-primary shadow w-75"
        style="min-height: 100%;">
            <div class='container'>
                <h1>Evaluations</h1>
            </div>
            <form id="alphaSort" action="/evaluations.php" method="post" 
            style="display: inline;">

                <button id="" class="btn btn-info" type="submit" 
                form="alphaSort">
                    Sort alphabetically
                </button>

                <!-- chevron indicating the direction the evaluations are being sorted in -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="39px" height="25px"
                    viewBox="0 0 1134 715">
                    <path id="sortChev"
                    fill="black" stroke="black" stroke-width="1"
                    d="" 
                    />
                </svg>

                <?php
                    if(($_REQUEST['alphaSort']))
                    {
                        if($_REQUEST['alphaSort'] == 'true')
                        {
                            print('
                                <input id="aSortIn" name="alphaSort" value="false" hidden>
                                <script>
                                    chevronDirection();
                                </script>
                            ');
                        }
                        else
                        {
                            print('
                                <input id="aSortIn" name="alphaSort" value="true" hidden>
                                <script>
                                    chevronDirection();
                                </script>
                            ');
                        }
                    }
                    else
                    {
                        print('
                            <input id="aSortIn" name="alphaSort" value="true" hidden>
                        ');
                    }
                ?>
            </form>
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

                    // if the alphabetical sort has been activated check the value
                    // sort ascending or descending accordingly
                    if((isset($_REQUEST['alphaSort'])))
                    {
                        if($_REQUEST['alphaSort'] == 'true')
                        {
                            $selectStatement = $conn->prepare("SELECT NAME FROM
                            Quiz ORDER BY NAME ASC");
                        }
                        else
                        {
                            $selectStatement = $conn->prepare("SELECT NAME FROM
                            Quiz ORDER BY NAME DESC");
                        } 
                    }
                    else
                    {
                        $selectStatement = $conn->prepare("SELECT NAME FROM
                        Quiz");
                    }

                    $selectStatement->execute();

                    // close database connection
                    $conn = null;

                    $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);

                    // closing the connection
                    $conn = null;

                    // printing out a button for each quiz stored in the database table
                    foreach($result as $data)
                    {
                        // 
                        printf('
                            <form id="form2" action="takeEvaluation.php" method="post">
                                <input type="submit" class="btn btn-primary" 
                                name="takeEvaluation" value="' . $data['NAME'] . '">
                                <br />
                            </form>

                            <form id="mod' . $data['NAME'] . '" action="modEvaluation.php" method="post">
                                <input hidden name="quizMod" value="' . $data['NAME'] . '">
                            </form>

                            <form id="delete' . $data['NAME'] . '" 
                            action="deleteEvaluation.php" method="post" onsubmit="return interceptDelete()">
                                <input hidden name="quizDelete" value="' . $data['NAME'] . '">
                            </form>
                            
                            <br />
                            <button type="submit" form="mod' . $data['NAME'] . '" 
                            class="btn btn-warning">
                                Modify
                            </button>

                            <button type="submit" form="delete' . $data['NAME'] . '"
                            class="btn btn-danger">
                                Delete
                            </button>
                            <br /><br /><br />
                        ');
                    }

                } 
                catch(PDOException $e) 
                {
                    echo "Error: " . $e->getMessage();
                }
            ?>
        </div>
        <?php

            // the bottom link that takes you to the top of the page when clicked
            include './includes/bottomLink.php';
        ?>
    </body>
</html>