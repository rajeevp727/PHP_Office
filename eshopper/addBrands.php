<?php
require "config/config.inc.php";
$title = "Create New Brand";
include "header.php";

if(isset($_POST["addBrand"])){
    if(!empty($_POST['brandName'])){
        $bName = $_POST['brandName'];
    $sql = mysqli_query($conn, "INSERT INTO brands(brandName) VALUES ('$bName')");
    if($sql){
        echo "<script>alert('New Brand Added');</script>";
        header("location: index.php");
    }else{
        echo "<script>alert('Insert Failed, try again')</script>";
    }
}
}
?>
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
            <form method="post">
                <label for="">Brand Name</label>
                <input type="text" name="brandName">    
                <input type="submit" name="addBrand" value="Create New Brand" style="width:130px; background-color:orange">

            </form>
        </div>
    </div>
</div>                
<?php include "footer.php"; ?>
</body>
</html>