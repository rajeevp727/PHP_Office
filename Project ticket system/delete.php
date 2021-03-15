
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Ticket System - Delete</title>
</head>
<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();   }
    // print_r($_SESSION);
    include "DB_Connect.php";
    if(!empty($_GET['id'])){
        $user = $_SESSION['userType'];
        $_SESSION['createdBy'] = $user;
        $stmnt = $conn->prepare("SELECT * from tickets WHERE id=:id");
        $stmnt->execute([":id"=>$_GET['id']]);
        while($row = $stmnt->fetch(PDO::FETCH_ASSOC)){
            $name= $row['createdBy'];  echo "<br>"."Only <b>".$name."</b> can delete this record.";
            if($name == $_SESSION['createdBy']){
        $stmnt1 = $conn->prepare("delete from tickets where id=:id");
        $stmnt1->execute([":id"=>$_GET['id']]);
        header("location: homepage.php");
            }else { echo "<script>alert('Invalid User, cannot delete this record')</script>"; }
  }
}else { echo "<script>alert('Invalid session, try logiing in again')</script>"; }
    ?>
</body>
</html>