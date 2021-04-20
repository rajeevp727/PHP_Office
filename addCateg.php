<?php
require "config/config.inc.php";
$title = "Create New Brand";
include "header.php";

if(isset($_POST["addCteg"])){
    if(!empty($_POST['categName']) || !empty($_POST['categDesc'])){
        $cName = $_POST['categName'];
        $cDesc = $_POST['categDesc'];
    $sql = mysqli_query($conn, "INSERT INTO categories(categName, categDesc) VALUES ('$cName', '$cDesc')");
    if($sql){
        echo "<script>alert('New Category Added');</script>";
        echo "<script>window.locationlhref='index.php';</script>";
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
                <label for="">Category Name</label>
                <input type="text" name="categName"> <br>
                <label for="">Category Desciption</label>
                <input type="text" name="categDesc"> <br>
                <input type="submit" name="addCteg" value="Create New Brand" style="width:130px; background-color:orange">

            </form>
        </div>
    </div>
</div>                
<?php include "footer.php"; ?>
</body>
</html>