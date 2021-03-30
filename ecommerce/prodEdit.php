<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="products.css">
    <title>Edit Products</title>
</head>
<body>
<?php
if(isset($_SESSION['user'])){
include "DB_Connect.php";
$id = $prodDesc = $prodName = $prodPrice = "";
// if(isset($_POST['btnCategUpdate'])){
$sql_prodEdit = $conn->prepare("SELECT * FROM products where id=:id");
$sql_prodEdit->execute([":id"=>$_GET['id']]);

while($rows= $sql_prodEdit->fetch(PDO::FETCH_ASSOC)){
    $id= $rows['id'];
    $prodName = $rows['prodName'];
    $prodDesc = $rows['prodDesc'];
    $prodPrice = $rows['prodPrice'];
}
if(isset($_POST['btnProdEdit'])){
if(isset($_POST['id'])){
    $stmnt_prodUpdate = $conn->prepare("UPDATE products SET prodName=:pName, prodDesc=:pDesc, prodPrice=:pPrice where id=:id");
    $stmnt_prodUpdate->bindParam(":id", $_POST['id']);
    $stmnt_prodUpdate->bindParam(":pName", $_POST['prodName']);
    $stmnt_prodUpdate->bindParam(":pDesc", $_POST['prodDesc']);
    $stmnt_prodUpdate->bindParam(":pPrice", $_POST['prodPrice']);
    $stmnt_prodUpdate->execute(); 
    header("location: homepage.php");
    } 
}
?>

<div class="Prod-form">
    <form name="Prod" action="#" method="post">
		<p class="hint-text">Edit your Products here.</p>
        <div class="form-group">
            <input type="text" class="form-control" name="id" value=<?php echo $id; ?> readonly>
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="prodName" value=<?php echo $prodName; ?>>
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="prodDesc" value= <?php echo $prodDesc; ?>>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="prodPrice" value=<?php echo $prodPrice; ?>>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnProdEdit">Edit Product</button>
        </div>
    </form>
</div>  
<?php }else{
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
</body>
</html>