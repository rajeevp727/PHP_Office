<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System - Delete</title>
</head>
<body>
    <?php
    include 'db_connect.php';
    session_start();
    $id = $_GET['id']; // Get id from URL
    $sqlDelete = "DELETE FROM tickets WHERE id = $id";
    if($conn == TRUE){
        $stmnt = $conn->prepare($sqlDelete);
        $stmnt->execute();
        header("location: homePage.php");
    }
    ?>
</body>
</html>