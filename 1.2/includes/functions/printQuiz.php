<?php
    function printQuiz(array $array)
    {
        $qCount = 1;

        $qArray = array();

        // test
        //print('server request method was post <br />');

        // Putting the questions into an array while
        // retaining the original key values to shuffle them for the
        // user
        $isAnswer;
        $isFirst = true;

        //test
        //print('<pre>');
        //print_r($array);
        //print('</pre>');

        foreach ($array as $key => $value) 
        {  
            if($key[0] == 'q' || $isFirst)
            {
                $isAnswer = false;
            }
            else
            {
                $isAnswer = true;
            }

            if(!$isAnswer && !$isFirst)
            {
                $qArray[$key] = $value;

                // test
                //print_r($qArray);
                //print('<br />');
            }

            $isFirst = false;
        }

        // test
        /*
        print('<pre>');
        print_r($array);
        print('</pre>');
        */

        // Shuffle the question array to make the user print out less predictable
        uasort($qArray, function($a, $b) 
        {
            return rand(-1, 1);
        });

        // Printing out the questions for the user to answer
        foreach($qArray as $key => $value)
        {
            // User print out
            printf('Question ' . $qCount . ': ' . $value
                . '<br /> <input type="text" name=' . $key . ' >
                <br /><br />'
            );
            $qCount++;
        }
    }
?>