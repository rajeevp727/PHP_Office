<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Products</title>
</head>
<body>
<?php
if(isset($_SESSION['user'])){
    include "DB_Connect.php";
    if(!empty($_GET['id'])){
    $sql_proddelete = $conn->prepare("DELETE FROM products where id=:id");
    $sql_proddelete->execute([":id"=>$_GET['id']]);
        header("location: homepage.php");
    }
    ?>
<?php }else{ 
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>

</body>
</html>