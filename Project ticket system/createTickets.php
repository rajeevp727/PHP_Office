<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tickets</title>
</head>
<body>
    <?php 
    include "db_connect.php";
    if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();  }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['createTicket'])){

        $createdBy = $comments = $status = $createFlag = "";

        $createdBy = $_SESSION['fName'];
        $createFlag = $_SESSION['fName'];
        $comments = $_POST['comments'];
        $status = $_POST['status'];
        
        $stmnt = $conn->prepare("insert into tickets(createdBy, comments, status) values(:createdBy ,:Comments ,:status)");
        $stmnt->execute([":createdBy"=>$createdBy,
                         ":Comments"=>$comments,
                         ":status"=>$status]);
                         
        $_SESSION['createdBy'] = $createdBy;
        $_SESSION['createFlag'] = $createFlag;
        print_r($_SESSION);
        
        header("location: homePage.php");
    }
    ?>
    <h1 style="text-align:center">Create Ticket - 
    <?php 
    if(!empty($_SESSION['userType'])){echo $_SESSION['fName']."(".$_SESSION['userType'].")" ?></h1>
    <form method="post">
        <input type="hidden" name="createFlag">
        <input type="text" name="craetedBy" readonly="true" tooltip="Created By: " value=<?php echo $_SESSION['fName'] ?> ><br>
        <textarea name="comments" cols="22" rows="5" placeholder="Enter your comments"></textarea> <br>
        <select name="status" >
        <option value="Active">Active</option>
        <option value="Pending">Pending</option>
        <option value="Closed">Closed</option>
        </select> <br>
        <input type="submit" value="Create" name="createTicket">
    </form>
    <?php } else{ echo "<script>alert('Invalid Session, login again')</script>"; }
    } else { echo "<script>alert('Invalid Session, try logging in agian')</script>"; }
    ?>
</body>
</html>