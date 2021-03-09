<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "ticketingsystem";

    try{
         $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_password);
         // set the PDO error mode to exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "<script>alert('Connected Successfully')</script>";

    }catch(PDOException $e){
        echo "Failed to connect DataBase". $e->error;
    }
?>