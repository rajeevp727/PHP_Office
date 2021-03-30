<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Categories</title>
</head>
<body>
    <?php
    if(isset($_SESSION['user'])){
    include "DB_Connect.php";
    if(!empty($_GET['id'])){
    $sql_categdelete = $conn->prepare("DELETE FROM categories where id=:id");
    $sql_categdelete->execute([":id"=>$_GET['id']]);
        header("location: homepage.php");
    }
    ?>
<?php }else{ echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>

</body>
</html>