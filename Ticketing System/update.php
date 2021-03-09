<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();   }
    include 'db_connect.php';


    if(!empty($_GET['id'])){     
    if($conn == TRUE){
        $stmnt = $conn->prepare("select * from tickets where `id`=:id");
        $stmnt->bindParam(':id',$_GET['id']);
        $stmnt->execute();
    }
    ?>
    <table border = 1>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Created</th>
            <th>Status</th>
        </tr>
        <tr>
        <form method="post" name="frmUpdate">
    <?php
        while($row=$stmnt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><input type=text name=id value=$row[id]></td>".
                 "<td><input type=text name=fname value=$row[firstName]></td>".
                 "<td><input type=text name=lname value=$row[lastName]></td>".
                 "<td><input type=text name=email value=$row[email]></td>".
                 "<td><input type=text name=message value=$row[message]></td>".
                 "<td><input type=text name=created value=$row[created]></td>".
                 "<td>
                    <select name=status value=$row[status]>
                        <option value=active>Active</option>
                        <option value=pending>Pending</option>
                         <option value=closed>Closed</option>
                    </select>
                 </td>";
                 "</tr>";
        }
    } else { echo "Invalid Id"; }
    ?>
    </table>
    
    <input type="submit" name="update" value="Update">
    </form>

    <?php
     if(isset($_POST['id'])){    
        $stmnt1 = $conn->prepare("UPDATE tickets SET firstName=:fname, lastName=:lname, email=:email, message=:message, status=:status WHERE id=:id");

        $stmnt1->execute(array(':id'=>trim($_POST['id']),
                               ':fname'=>trim($_POST['fname']),
                               ':lname'=>trim($_POST['lname']),
                               ':email'=>trim($_POST['email']),
                               ':message'=>trim($_POST['message']),
                               ':status'=>trim($_POST['status'])));
        header("location:homePage.php");
    // }
 }
    ?>
</body>
</html>