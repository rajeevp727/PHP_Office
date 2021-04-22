<?php
// session_start();

/*
Error reporting
*/
// error_reporting(0);

/*
Database Connection 
*/

$conn = mysqli_connect("localhost", 'root', '', 'ecommerce');

if(!$conn){
    echo '<h2>Could not Connect to Database, Please check your Database Connection</h2>'; 
    exit;
}