<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="categories.css">
<title>Add Categories</title>
</head>
<body>
<h1><marquee>Create a new Category</marquee></h1>
<?php
if(isset($_SESSION['user'])) {
include "DB_Connect.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['categName']) || !empty($_POST['categDesc'])){
        $categName = trim($_POST['categName']);
        $categDesc = trim($_POST['categDesc']);
    if(isset($_POST['categAdd'])){
        try{
        $sql_categ_add = $conn->prepare("INSERT INTO `categories`(`categName`, `categDesc`) VALUES (:categname, :categDesc)");
        $sql_categ_add->execute([":categname"=>$categName, ":categDesc"=>$categDesc]);
        echo "<script>alert('New category created');</script>";
        }catch(PDOException $e){ echo "error".$e->getMessage(); }

        header("location: homepage.php");
    }
}else{ echo "<script>alert('Fields cannot be empty');</script>"; }
}
?>    
<div class="Categ-form">
    <form name="Categ" method="post">
		<p class="hint-text">Add your new categories here.</p>
		<div class="form-group">
            <input type="text" class="form-control" name="categName" placeholder="Name your Category" required autofocus>
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="categDesc" placeholder="Descibe your Category" required>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="categAdd">Add category</button>
        </div>
    </form>
</div>

<?php }else{ 
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
</body>
</html>