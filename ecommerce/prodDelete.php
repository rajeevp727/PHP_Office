<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Products</title>
</head>
<body>
<?php
    include "DB_Connect.php";
    if(!empty($_GET['id'])){
    $sql_proddelete = $conn->prepare("DELETE FROM products where id=:id");
    $sql_proddelete->execute([":id"=>$_GET['id']]);
        header("location: homepage.php");
    }
    ?>
</body>
</html>