<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System - Create Ticket</title>
    <style>
        .error { color: red; }
    </style>    
</head>
<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

        $firstName = $lastName = $email = $message = $status = $created = "";
        $firstNameErr = $lastNameErr= $emailErr= $messageErr = $statusErr= $createdErr = "";
    ?>

    <form action="#" method="post">
    <h1 style="text-align:center;">Ticketing System</h1>
    <h2>Create a Ticket</h2>
    <input type="text" readonly= "true" name="fName" value="<?php echo $_SESSION['un'] ?>"placeholder = "Enter your First Name"><span class = "error">*<?php echo $firstNameErr?></span> <br> <br>
    <input type="text" readonly= "true" name="lName"value="<?php echo $_SESSION['sess_pswrd']; ?>" placeholder = "Enter your Last Name"><span class = "error">*<?php echo $lastNameErr?></span> <br> <br>
    <textarea name="msg" cols="20" rows="5" placeholder = "Enter your message here"></textarea><span class = "error">*<?php echo $messageErr?></span> <br> <br>
    <input type="text" name="email" placeholder = "Enter your Email here"><span class = "error">*<?php echo $emailErr?></span> <br> <br>
    <!-- <input type="text" name="status" placeholder = "Enter the Status of your ticket"><span class = "error">*<?php echo $statusErr?></span> <br> <br> -->
    <!-- <label for="Status"> -->
        <select name="status" id="status">
            <option value="active">Active</option> <?php if($_POST['status'] == 'active') { $status = $_POST['status']; } ?>
            <option value="pending">Pending</option> <?php if($_POST['status'] == 'pending') { $status = $_POST['status']; } ?>
            <option value="closed">Closed</option> <?php if($_POST['status'] == 'closed') { $status = $_POST['status']; } ?>
        </select>
    </label><br> <br>
    <input type="submit" value="Submit" name = "submit" style="background-color:rgb(59, 216, 59)">
        <input type="submit" value="Click here go to home page" style="background-color:skyblue; " name = "home">
    </form>

    <?php
    include 'db_connect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["fName"])){ $firstNameErr = "First name is required";}
        else{ $firstName = trim($_POST["fName"]);}

        if(empty($_POST["lName"])){ $lastNameErr = "Last name is required";}
        else{ $lastName = trim($_POST["lName"]);}
        
        if(empty($_POST["msg"])){ $messageErr = "Message is required";}
        else{ $message = trim($_POST["msg"]);}

        if(empty($_POST["email"])){ $emailErr = "Email is required";}
        else {$email = "Invalid Email";}

    if(isset($_SESSION['un'])){
    if(isset($_POST['submit'])){
      if(!(empty($firstName) || empty($lastName) || empty($message) || empty($email) || empty($status) )){
        try{
            $conn = new PDO("mysql:host=$db_host; dbname=ticketingsystem", $db_user, $db_password); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $firstName = $_POST['fName'];
            $lastName = $_POST['lName'];
            $message = $_POST['msg'];
            $email = $_POST['email'];
            // $status = $_POST['status'];
            $created = date('Y-m-d H:i:s');

            $stmnt = $conn->prepare("INSERT INTO tickets (`firstName`, `lastName`, `email`, `message`, `created`, `status`) 
            VALUES(:fName, :lName, :email, :message, :created, :status)");
            $stmnt->bindParam(':fName', $firstName);
            $stmnt->bindParam(':lName', $lastName);
            $stmnt->bindParam(':email', $email);
            $stmnt->bindParam(':message', $message);
            $stmnt->bindParam(':created', $created);
            $stmnt->bindParam(':status', $status);

            $stmnt->execute();
            echo "<script>alert('New Record successfully Inserted into table')</script>";
            }
            catch(PDOException $e){ echo $e->getMessage(); }
        }else{  echo "<script>alert('Filed values cannot be empty')</script>";  }
    }
    if(isset($_POST['home'])){ header("location: homePage.php");  }
}else{ echo "<script>alert('Invalid Session')</script>"; }
}
?>
    
</body>
</html>