<?php
    $dsn = 'mysql:host=localhost;dbname=cs602db';
    $username = 'cs602_user';
    $password = 'cs602_secret';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); 

    // Assignment note! I have modified this file to set the error mode as demonstrated in textbook Chapter 19 

    try {
        $db = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>