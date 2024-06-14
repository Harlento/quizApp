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
        <div class="container rounded border border-primary shadow w-75"
        style="min-height: 100%;">
            <div class='container'>
                <h1>Quizes</h1>
            </div>
            <form id="alphaSort" action="/oldQuiz.php" method="post" 
            style="display: inline;">

                <button id="" class="btn btn-info" type="submit" 
                form="alphaSort">
                    Sort alphabetically
                </button>


                <!-- image tage chevron -->
                <!-- <img id="sortChev" src=""> -->

                <!--  -->
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
                    // test
                    //print('Try block <br />');

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
            ?>
        </div>

        <a style="text-decoration: none;" class="linkHover bottomLink" href="#top" aria-label="Back to top">
            <div class="d-flex p-2 justify-content-center bg-primary text-white">
                <span class="text">Back to top</span>
            </div>
        </a>
    </body>
</html>