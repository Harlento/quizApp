<?php
    // 
    function printQuiz(array $array)
    {
        $qCount = 1;

        $qArray = array();

        // Putting the questions into an array while
        // retaining the original key values to shuffle them for the
        // user
        $isAnswer = false;
        $isFirst = true;

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
            }

            $isFirst = false;
        }

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