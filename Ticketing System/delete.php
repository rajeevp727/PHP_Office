<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System - Delete</title>
</head>
<body>
    <?php
    include 'db_connect.php';
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    If(!empty($_GET['id'])){
    $id = $_GET['id']; // Get id from URL
    $sqlDelete = "DELETE FROM tickets WHERE id = $id";
    if($conn == TRUE){
        $stmnt = $conn->prepare($sqlDelete);
        $stmnt->execute();
        header("location: homePage.php");
    }
}else{ echo "Inavlid Id, try again"; }
    ?>
</body>
</html>