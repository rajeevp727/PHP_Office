<?php
require "config/config.inc.php";
$title = "Create New Brand";
include "header.php";

if(isset($_GET["id"])){
        $b_id = $_GET['id'];
        echo $b_id;
    $sql = mysqli_query($conn, "DELETE FROM brands where id='$b_id'");
    if($sql){
        echo "<script>alert('Are you sure to delete this Brand?');</script>";
        echo "<script>alert('Brand Deleted');</script>";
        echo "<script>window.location.href='index.php'</script>";
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