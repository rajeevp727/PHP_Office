<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Products</title>
</head>
<body>
    <?php
    if(isset($_SESSION['user'])){
    include "DB_Connect.php";
    if(!empty($_GET['id'])){
    $sql_categdelete = $conn->prepare("DELETE FROM products where id=:id");
    $sql_categdelete->execute([":id"=>$_GET['id']]);
        header("location: listProd.php");
    } else { echo "<script>alert('ID cannot be empty');</script>"; }
    ?>
<?php }else{ echo "<script>alert('User Doesnot exist');</script>"; } ?>

</body>
</html>