<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Categories</title>
</head>
<body>
<h1><marquee direction="right">Create a new Category</marquee></h1>
<?php
include "DB_Connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['categName']) || !empty($_POST['categDesc'])){
        $categName = $_POST['categName'];
        $categDesc = $_POST['categDesc'];
    }else{ echo "<script>alert('Fields cannot be empty');</script>"; }
    if(isset($_POST['categAdd'])){
        try{
        $sql_categ_add = $conn->prepare("INSERT INTO `categories`(`categName`, `categDesc`) VALUES (:categname, :categDesc)");
        $sql_categ_add->execute([":categname"=>$categName, ":categDesc"=>$categDesc]);
        echo "<script>alert('New category created');</script>";
        }catch(PDOException $e){ echo "error".$e->getMessage(); }

        header("location: homepage.php");
    }
}
?>

    <form action="" method="post">
		<div class="form-group">
            <input type="text" class="form-control" name="categName" placeholder="Name your Category">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="categDesc" placeholder="Descibe your Category">
        </div>
        <div class="form-group">
            <input type="submit" value="Add Category" name="categAdd">
        </div>
    </form>
</body>
</html>