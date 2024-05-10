<?php
    // Start the session
    // Variables inside
    // $_SESSION['POST']
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Quiz Results</title>
    </head>
    <body>
        <?php
            $count = 1;
            $total = 0;
            $correct = 0;
            $score = 0;

            $question = "";

            //test
            /*
            print('Post array <br />');
            print_r($_POST);
            print('<br /><br />');
            print('Stored array <br />');
            print_r($_SESSION['POST']);
            print('<br /><br />');
            */

            // $value is the original answer provided by the quiz maker
            foreach($_SESSION['POST'] as $sKey => $sValue)
            {
                // Add one to the total
                $total++;

                $sKey = (int) $sKey;

                if($sKey % 2 == 0)
                {
                    // test
                    //printf('Even parity');
                    //print($sValue . '<br /><br />');

                    $sKey = (string) $sKey;

                    foreach($_POST as $pKey => $pValue)
                    {
                        $pKey = (int) $pKey;
                        $pKey = $pKey + 1;
                        $pKey = (string) $pKey;

                        if($pKey == $sKey)
                        {
                            if($sValue == $pValue)
                            {
                                // Question
                                printf('Question: ' . $question . '<br />');

                                // User answer
                                printf('Your answer: ' . $pValue . '<br />');

                                // Right answer
                                printf('Right answer: ' . $sValue . '<br /><br />');
                                $correct++;
                            }
                            else
                            {
                                // Question
                                printf('Question: ' . $question . '<br />');

                                // User answer
                                printf('Your answer: ' . $pValue . '<br />');

                                // Right answer
                                printf('Right answer: ' . $sValue . '<br /><br />');
                            }
                        }
                    }
                }
                else
                {
                    $question = $sValue;
                }
                //printf($value . '<br />');
            }
            printf('Your score: ' . $correct . '/' . ($total/2) . '<br />');
            $score = $correct/($total/2);
            printf("%.2f", $score * 100);
            print("%%");
        ?>

        <br /><br />
        <a href='/index.php'>Home</a>
    </body>
</html>