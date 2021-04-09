<?php
// include "Registration.php";
$db_host = "localhost";
$db_name = "ecommerce";
$db_user = "root";
$db_pass = "";

try{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to DB ".$db_name;
}catch(PDOExcepton $e){ echo "Failed to connecte to DB: ".$db_name.$e->getMessage() ; }
?>