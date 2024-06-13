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

            print('
                <div id="bodyDiv" class="container-xl rounded border border-primary shadow w-75"
                style="min-height: 100%;">
            ');

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

            //test
            /*
            print('<pre>');
            print_r($_SESSION['POST']);
            print('</pre>');
            print('<pre>');
            print_r($_POST);
            print('</pre>');
            */

            print('<br />');
            print('
                <h1>
                    Quiz Results
                </h1>
                <br /><br />
            ');

            // $value is the original answer provided by the quiz maker
            foreach($_POST as $postKey => $postValue)
            {
                $total++;
                $isAnswer = false;
                $isQuestion = false;
                $wasCorrect = false;
                $count = 0;

                // itterating through the session array seeking out the question
                // and it's acceptable answers
                foreach($_SESSION['POST'] as $sessionKey => $sessionValue)
                {
                    // test
                    //print('Current sessionValue: ' . $sessionValue . '<br />');
                    //print('Current sessionKey: ' . $sessionKey . '<br />');

                    // If the user answer key is equal to the session key it's the question to be compared
                    if($sessionKey == $postKey)
                    {
                        $isQuestion = true;
                        $count = 0;
                        print('<p class="boldInlinePara">Question: ' . $sessionValue . '</p><br /><br />');
                    }

                    // test
                    //print('First char of sessionKey: ' . $sessionKey[0] . '<br />');
                    //print('If it is the question being seeked: ' . $isQuestion . '<br />');
                    //print('The count var: ' . $count . '<br />');

                    // this is when the question has been found and the current key is an answer
                    if($sessionKey[0] == 'a' && $isQuestion)
                    {
                        if($sessionValue == $postValue)
                        {
                            $wasCorrect = true;
                        }

                        print('Acceptable answer: ' . $sessionValue . '<br />');

                        // test
                        //print('User answer: ' . $postValue . '<br />');
                    }
                    else if($sessionKey[0] == 'q' && $isQuestion && $count > 0)
                    {
                        print('Your answer: ' . $postValue . '<br />');

                        if($wasCorrect)
                        {
                            print("<p class='rightAnswer'>You're right :)</p><br />");
                        }
                        else
                        {
                            print("<p class='wrongAnswer'>WRONG >_<</p> <br />");
                        }

                        //print('<br />');
                        break;
                    }

                    $count++;

                    if($sessionKey === array_key_last($_SESSION['POST']))
                    {
                        print('Your answer: ' . $postValue . '<br />');

                        if($wasCorrect)
                        {
                            print("<p class='rightAnswer'>You're right :)</p> <br />");
                        }
                        else
                        {
                            print("<p class='wrongAnswer'>WRONG >_<</p> <br />");
                        }

                        //print('<br />');
                    }
                }

                // when the user provided one of the acceptable answers a bool will be true 
                // increment number of correct answers
                if($wasCorrect)
                {
                    $correct++;
                }
            }

            // their score


            // test //////////////////////////////////////////////////////////////////////////
            //print('Total variable: ' . $total . '<br /><br />');

            print('<br />');
            printf('<h3>Your score: ' . $correct . '/' . ($total) . '</h3><br />');
            $score = $correct/($total);
            $score = $score * 100;
            print('<h3>');
            printf("%.2f", $score);
            print('%');
            print('</h3>');
            print('<br /><br />');
            print('
                <div class="container">
                    <!-- This is a navbar link used in the middle of the page -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-white" 
                        aria-label="Lenton IT Navbar">
                        <div class="container-fluid">
                            <div class="" id="navbarsExample05">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link text" aria-current="page" 
                                            href="/index.php">
                                            Home
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            ');

            // 
            print('
                </div>
                <a style="text-decoration: none;" class="linkHover bottomLink" href="#top" aria-label="Back to top">
                    <div class="d-flex p-2 justify-content-center bg-primary text-white">
                        <span class="text">Back to top</span>
                    </div>
                </a>
            ');
        ?>
    </body>
</html>