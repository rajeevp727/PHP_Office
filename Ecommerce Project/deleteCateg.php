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
        $id=$_GET['id'];
    include "DB_Connect.php";
    if(!empty($id)){ 
    $sql_categdelete = $conn->prepare("DELETE FROM categories where id=:id");
    $sql_categdelete->execute([":id"=>$_GET['id']]);
        header("location: listCateg.php");
    }else{ echo "<script>alert('ID cannot be empty');</script>"; echo 5; exit(); } ?>
<?php }else{ echo "<script>alert('User Doesnot exist');</script>"; } ?>

</body>
</html>