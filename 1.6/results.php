<?php
    // Start the session
    // Variables inside
    // $_SESSION['POST']
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Evaluation Results</title>
        <?php
            include './includes/headLinks.php';
        ?>
    </head>
    <body>
        
        <?php
            include './includes/navbar.php';

            // 
            print('
                <div id="bodyDiv" class="container-xl rounded border border-primary shadow w-75"
                style="min-height: 100%;">
            ');

            $count = 1;
            $total = 0;
            $correct = 0;
            $score = 0;

            $question = "";

            // 
            print('<br />');
            print('
                <h1>
                    Evaluation Results
                </h1>
                <br /><br />
            ');

            // $value is the original answer provided by the quiz maker
            foreach($_POST as $postKey => $postValue)
            {
                // if the last character of the string is a space
                // then slice it out of the string
                if($postValue[strlen($postValue) - 1] == " ")
                {
                    // cut the last character off the end of the string before using it
                    $postValue = substr($postValue, 0, -1);
                }

                $total++;
                $isAnswer = false;
                $isQuestion = false;
                $wasCorrect = false;
                $count = 0;

                // itterating through the session array seeking out the question
                // and it's acceptable answers
                foreach($_SESSION['POST'] as $sessionKey => $sessionValue)
                {
                    // If the user answer key is equal to the session key it's the question 
                    // to be compared
                    if($sessionKey == $postKey)
                    {
                        $isQuestion = true;
                        $count = 0;
                        print('
                            <p class="boldInlinePara">Question: ' . $sessionValue . '</p>
                            <br /><br />
                        ');
                    }

                    // this is when the question has been found and the current key is an answer
                    if($sessionKey[0] == 'a' && $isQuestion)
                    {
                        // check if the answer is correct
                        if($sessionValue == $postValue)
                        {
                            $wasCorrect = true;
                        }

                        print('Acceptable answer: ' . $sessionValue . '<br />');
                    }
                    else if($sessionKey[0] == 'q' && $isQuestion && $count > 0)
                    { // if it is a question input, it's the question being seeked,
                        // and it's not the first member of the array print it out
                        print('Your answer: ' . $postValue . '<br />');

                        if($wasCorrect)
                        {
                            print("<p class='rightAnswer'>You're right :)</p><br />");
                        }
                        else
                        {
                            print("<p class='wrongAnswer'>WRONG >_<</p> <br />");
                        }

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

            // this is the bottom link that will take you to the top of the page when clicked
            include './includes/bottomLink.php';
        ?>
    </body>
</html>