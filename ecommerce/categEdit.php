<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="categories.css">
<title>Edit Categories</title>
</head>
<body>
<?php
if(isset($_SESSION['user'])){
include "DB_Connect.php";
$id = $categDesc = $categName = "";

$sql_categEdit = $conn->prepare("SELECT * FROM categories where id=:id");
$sql_categEdit->execute([":id"=>$_GET['id']]);

while($rows= $sql_categEdit->fetch(PDO::FETCH_ASSOC)){
    $id= $rows['id'];
    $categName = $rows['categName'];
    $categDesc = $rows['categDesc'];
}
if(isset($_POST['categEdit'])){ 
if(isset($_POST['id'])){ 
    echo "<script>alert(1)</script>";
    $stmnt_categUpdate = $conn->prepare("UPDATE categories SET categName=:cName, categDesc=:cDesc where id=:id");
    $stmnt_categUpdate->bindParam(":id", $_POST['id']);
    $stmnt_categUpdate->bindParam(":cName", $_POST['categName']);
    $stmnt_categUpdate->bindParam(":cDesc", $_POST['categDesc']);
    $stmnt_categUpdate->execute();
    header("location: homepage.php");
    } 
}
?>

<div class="Categ-form">
    <form name="Categ" action="#" method="post">
		<p class="hint-text">Edit your Categories here.</p>
		<div class="form-group">
            <input type="text" class="form-control" name="id" value=<?php echo $id; ?> readonly autofocus>
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="categName" value=<?php echo $categName; ?>>
        </div>
        <div class="form-group">
            <input type="te" class="form-control" name="categDesc" value=<?php echo $categDesc; ?>>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="categEdit">Edit Category</button>
        </div>
    </form>
</div>
<?php }else{ echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
</body>
</html>