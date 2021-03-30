<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="products.css">
    <title>Add Products</title>
</head>
<body>
<?php if(isset($_SESSION['user'])){  ?>
<h1><marquee direction="right">Create a new product</marquee></h1>
<?php
include "DB_Connect.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(!empty($_POST['prodName']) || !empty($_POST['prodDesc']) || !empty($_POST['prodPrice'])){
        $prodName = $_POST['prodName'];
        $prodDesc = $_POST['prodDesc'];
        $prodPrice = $_POST['prodPrice'];
    }else{ echo "<script>alert('Fields cannot be empty');</script>";  }
    if(isset($_POST['ProdAdd'])){
        try{ echo 8;
        $sql_prod_add = $conn->prepare("INSERT INTO products(prodName, prodDesc, prodPrice) VALUES (:prodname, :prodDesc, :prodPrice)");
        $sql_prod_add->execute([":prodname"=>$prodName, ":prodDesc"=>$prodDesc, ":prodPrice"=>$prodPrice]);
        echo "<script>alert('New product created');</script>";
        }catch(PDOException $e){ echo "error".$e->getMessage(); }
        header("location: homepage.php");
    } 
}
?>

<div class="Prod-form">
    <form name="Prod" method="post">
		<p class="hint-text">Add your new Products here.</p>
		<div class="form-group">
            <input type="text" class="form-control" name="prodName" placeholder="Name your Product" required autofocus>
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="prodDesc" placeholder="Descibe your Product" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="prodPrice" placeholder="Price your Product" required>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="ProdAdd">Add Product</button>
        </div>
    </form>
</div>  
<?php }else{ echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
</body>
</html>