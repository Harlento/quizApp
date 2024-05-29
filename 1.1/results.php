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
        <?php
            include './includes/headLinks.php';
        ?>
    </head>
    <body>
        
        <?php
            include './includes/navbar.php';

            print('<div class="container rounded border border-primary shadow w-50">');

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

            // test ///////////////////////////////////////////////////////////////////////
            //print_r($_SESSION['POST']);
            //print("<br /><br />");

            // $value is the original answer provided by the quiz maker
            foreach($_SESSION['POST'] as $sessionKey => $sessionValue)
            {
                // Add one to the total
                $total++;

                $sessionKey = (int) $sessionKey;

                if($sessionKey % 2 == 0)
                {
                    // test
                    //printf('Even parity');
                    //print($sValue . '<br /><br />');

                    $sessionKey = (string) $sessionKey;

                    foreach($_POST as $postKey => $postValue)
                    {
                        $postKey = (int) $postKey;
                        $postKey = $postKey + 1;
                        $postKey = (string) $postKey;

                        if($postKey == $sessionKey)
                        {
                            $postValueU = strtoupper($postValue);
                            $sessionValueU = strtoupper($sessionValue);

                            if($sessionValueU == $postValueU)
                            {
                                // Question
                                printf('Question: ' . $question . '<br />');

                                // User answer
                                printf('Your answer: ' . $postValue . '<br />');

                                // Right answer
                                printf('Right answer: ' . $sessionValue . '<br />');

                                printf("Correct :) <br /><br />");

                                $correct++;
                            }
                            else
                            {
                                // Question
                                printf('Question: ' . $question . '<br />');

                                // User answer
                                printf('Your answer: ' . $postValue . '<br />');

                                // Right answer
                                printf('Right answer: ' . $sessionValue . '<br />');

                                printf("WRONG <br /><br />");
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

            // test //////////////////////////////////////////////////////////////////////////
            //print('Total variable: ' . $total . '<br /><br />');

            $total = $total/2;

            $total = (int) $total;

            printf('Your score: ' . $correct . '/' . ($total) . '<br />');
            $score = $correct/($total);
            printf("%.2f", $score * 100);
            print('%');
            print('</div>');
        ?>
        <br /><br />

        <div class="container">
            <!-- This is a navbar link used in the middle of the page -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white" 
                aria-label="Lenton IT Navbar">
                <div class="container-fluid">
                    <div class="" id="navbarsExample05">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text" aria-current="page" 
                                href='/index.php'>
                                    Home
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </body>
</html>