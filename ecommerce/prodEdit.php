<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
</head>
<body>
<?php
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
// }
?>
    <form action="" method="POST">
    <table border=1px>
    <tr> <td>Product ID</td> <td> <input type="text" name="id"  value= <?php echo $id; ?> ></td> </tr>
    <tr> <td>Product Name</td> <td> <input type="text" name="prodName" value= <?php echo $prodName; ?>></td> </tr>
    <tr> <td>Product Description</td> <td> <input type="text" name="prodDesc" value= <?php echo $prodDesc; ?>></td> </tr>
    <tr> <td>Product Price</td> <td> <input type="number" name="prodPrice" value= <?php echo $prodPrice; ?>></td> </tr>
    </tr>
    
    </tr>
    </table>
    <input type="submit" value="Update">
    </form>

<?php
if(isset($_POST['id'])){ 
    $stmnt_prodUpdate = $conn->prepare("UPDATE products SET prodName=:pName, prodDesc=:pDesc, prodPrice=:pPrice where id=:id");
    $stmnt_prodUpdate->bindParam(":id", $_POST['id']);
    $stmnt_prodUpdate->bindParam(":pName", $_POST['prodName']);
    $stmnt_prodUpdate->bindParam(":pDesc", $_POST['prodDesc']);
    $stmnt_prodUpdate->bindParam(":pPrice", $_POST['prodPrice']);
    $stmnt_prodUpdate->execute();
    header("location: homepage.php");
} 
?>

</body>
</html>