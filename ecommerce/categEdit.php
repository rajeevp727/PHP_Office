<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Categories</title>
</head>
<body>
<?php
include "DB_Connect.php";
$id = $categDesc = $categName = "";
// if(isset($_POST['btnCategUpdate'])){
$sql_categEdit = $conn->prepare("SELECT * FROM categories where id=:id");
$sql_categEdit->execute([":id"=>$_GET['id']]);

while($rows= $sql_categEdit->fetch(PDO::FETCH_ASSOC)){
    $id= $rows['id'];
    $categName = $rows['categName'];
    $categDesc = $rows['categDesc'];
}
// }
?>
    <form action="" method="POST">
    <table border=1px>
    <tr> <td>Category ID</td> <td> <input type="text" name="id"  value= <?php echo $id; ?> ></td> </tr>
    <tr> <td>Category Name</td> <td> <input type="text" name="categName" value= <?php echo $categName; ?>></td> </tr>
    <tr> <td>Category Description</td> <td> <input type="text" name="categDesc" value= <?php echo $categDesc; ?>></td> </tr>
    </tr>
    
    </tr>
    </table>
    <input type="submit" value="Update">
    </form>

<?php
if(isset($_POST['id'])){ 
    echo "<script>alert(1)</script>";
    $stmnt_categUpdate = $conn->prepare("UPDATE categories SET categName=:cName, categDesc=:cDesc where id=:id");
    $stmnt_categUpdate->bindParam(":id", $_POST['id']);
    $stmnt_categUpdate->bindParam(":cName", $_POST['categName']);
    $stmnt_categUpdate->bindParam(":cDesc", $_POST['categDesc']);
    $stmnt_categUpdate->execute();
    header("location: homepage.php");
} 
?>
</body>
</html>