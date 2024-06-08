<?php
    function connectDatabase()
    {
        //test
        //print('connectDatabase has executed :)');

        // connect to the database
        try 
        {
            $conn = new PDO("mysql:host=localhost;dbname=QuizDatabase", "root", "Chyuugokugo2");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully"; 
        } 
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
?>