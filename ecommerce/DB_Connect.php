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

// $sql_reg_insert = "INSERT INTO users(fname, lname, email,  userName, password, confirmPassword) 
//                         VALUES(:fName, :lName, :email, :userName, :pass, :confPass)";
// $stmnt_reg = $conn->prepare($sql_reg_insert);
// $stmnt_reg->execute([":first_name"=> $fName, ":last_name"=>$lName, ":email"=> $email, 
//                         ":password"=>$pass, ":confirm_password"=>$confPass]);
// echo "<script>alert('Data Successfully inserted');</script>";
?>