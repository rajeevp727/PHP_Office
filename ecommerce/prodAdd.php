<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Products</title>
</head>
<body>
<h1><marquee direction="right">Create a new product</marquee></h1>
<?php
include "DB_Connect.php";
echo 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){ echo 1;
    if(!empty($_POST['prodName']) || !empty($_POST['prodDesc']) || !empty($_POST['prodPrice'])){ echo 2;
        $prodName = $_POST['prodName'];
        $prodDesc = $_POST['prodDesc'];
        $prodPrice = $_POST['prodPrice'];
    }else{ echo "<script>alert('Fields cannot be empty');</script>"; }
    if(isset($_POST['prodAdd'])){
        try{
        $sql_prod_add = $conn->prepare("INSERT INTO products(prodName, prodDesc, prodPrice) VALUES (:prodname, :prodDesc, :prodPrice)");
        $sql_prod_add->execute([":prodname"=>$prodName, ":prodDesc"=>$prodDesc, ":prodPrice"=>$prodPrice]);
        echo "<script>alert('New product created');</script>";
        }catch(PDOException $e){ echo "error".$e->getMessage(); }
        header("location: homepage.php");
    } 
}
?>
    <form action="" method="POST">
		<div class="form-group">
            <input type="text" class="form-control" name="prodName" placeholder="Name your Product">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="prodDesc" placeholder="Descibe youProductr Product">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="prodPrice" placeholder="Price your Product">
        </div>
        <div class="form-group">
            <input type="submit" value="Add Product" name="prodAdd">
        </div>
    </form>

</body>
</html>