<?php
if(isset($_GET["id"])){
        $c_id = $_GET['id'];
        echo $b_id;
    $sql = mysqli_query($conn, "DELETE FROM categories where id='$c_id'");
    if($sql){
        echo "<script>alert('Are you sure to delete this Category?');</script>";
        echo "<script>alert('Category Deleted');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}
?>