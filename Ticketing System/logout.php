<?php 
include 'Login.php';
session_start();
$_SESSION['sess_username'] = "";
$_SESSION['sess_username'] = "";
 = $_SESSION['username'];
if (empty($_SESSION['sess_username'])){
    // header("location: Login.php");
    header("location: userRegistration.php");
}
session_unset;
session_destroy();

?>