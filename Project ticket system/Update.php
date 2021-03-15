<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Update Tickets</title>
</head>
<body>
    <?php
    include "db_connect.php";
    // print_r($_SESSION);
    if(!empty($_GET['id'])){
        $stmnt = $conn->prepare("select * from tickets where id=:id");
        $stmnt->execute([":id"=>$_GET['id']]);
        ?>
        <form method="post">
    <table border=1>
    <tr>
        <th>Id</th>
        <th>Created By</th>
        <th>Comments</th>
        <th>Created</th>
        <th>Status</th>
    </tr>
        <?php
        while($row = $stmnt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>".
            "<td><input id=id type=text name=id value=$row[id] readonly></td>".
            "<td><input type=text name=createdBy value=$row[createdBy] readonly></td>".
            "<td><input type=text name=comments value=$row[comments]></td>".
            "<td><input readonly id=created type=text name=created value=$row[created]></td>".
            "<td>
                <select name=status id=selectStatus value=$row[status]>
                    <option value=Active>Active</option>
                    <option value=Pending>Pending</option>";                    
                    
                    if($_SESSION['userType'] == "Manager" || $_SESSION['userType'] == "Tester"){                    
                    echo "<option value=Closed>Closed</option>";
                    } 
                 echo "</select>
                </td>";
        }
    }
    else{ echo "Invalid Id"; }
    ?>
    </table>
    <input type="submit" value="Update">
    </form>
    <?php
    if(isset($_POST['id'])){
        $stmnt1 = $conn->prepare("UPDATE tickets SET createdBy=:createdBy, comments=:comments, status=:status where id=:id");
        $stmnt1->execute(array(':id'=>trim($_POST['id']),
                               ':createdBy'=>trim($_POST['createdBy']),
                               ':comments'=>trim($_POST['comments']),
                               ':status'=>trim($_POST['status'])));
        header("location: homePage.php");
    } 
    ?>

</body>
</html>