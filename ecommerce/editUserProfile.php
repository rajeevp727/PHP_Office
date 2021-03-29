<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
include "DB_Connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Profile - <?php echo $_SESSION['user']; ?></title>
    <style>
    input{
        width: 100%;
    }
    body {
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}   
    </style>
</head>
<body>
<h1>User <i><?php if(isset($_SESSION['user'])){ echo $_SESSION['user']; }
            else{ echo "Invalid session, try <a href='Login.php'>logging in</a>"; exit(); } ?> Session Profile</h1>
    <?php
     $sql_getUsers = $conn->prepare("SELECT * from users where fName=:fname");
     $sql_getUsers->execute([":fname"=>$_SESSION['user']]);
     while($rows = $sql_getUsers->fetch(PDO::FETCH_ASSOC)){
         $fname= $rows['fName'];
         $lname= $rows['lName'];
         $email= $rows['email'];
         $userName= $rows['userName'];
         $pass= $rows['password'];
         $confPass= $rows['confirmPassword'];
     }
    ?>
    <form action="" method="post">
    <div>
    <table border=1px style="border-collapse: collapse; width:100%;">
    <tr><td>First Name</td><td><input type="text" value=<?php echo $fname; ?>></td></tr>
    <tr><td>Last Name</td><td><input type="text" value=<?php echo $lname; ?>></td></tr>
    <tr><td>Email</td><td><input type="text" value=<?php echo $email; ?>></td></tr>
    <tr><td>User Name</td><td><input type="text" value=<?php echo $userName; ?>></td></tr>
    <tr><td>Password</td><td><input type="password" value=<?php echo $pass; ?>></td></tr>
    <tr><td>Confirm Password</td><td><input type="password" value=<?php echo $confPass; ?>></td></tr>
</table> <br>
    </div>
    <input type="submit" value="Save Edit" name="btnSaveEdit" style="background-color:#66ff99; width:49%; float:left;">
    <input type="submit" value="Cancel Edit" name="btnCancelEdit" style="background-color:#ed736b; width:49%; float:right;">
    </form>
    
    <?php
    if(isset($_POST['btnSaveEdit'])){
        try{
            $sql_saveEdit = $conn->prepare("UPDATE users SET fName=:fname, lName=:lname, email=:email,
                    userName=:userName, password=:pass, confirmPassword=:confPass WHERE fName=:fname");
            $sql_saveEdit->bindParam(":fname", $fname);        
            $sql_saveEdit->bindParam(":lname", $lname);        
            $sql_saveEdit->bindParam(":email", $email);        
            $sql_saveEdit->bindParam(":userName", $userName);        
            $sql_saveEdit->bindParam(":pass", $pass);        
            $sql_saveEdit->bindParam(":confPass", $confPass);        

            $sql_saveEdit->execute();

            header("location: profile.php");
        } catch(PDOException $e){ echo "error ".$e.getMessage(); }
    }
    if(isset($_POST['btnCancelEdit'])){
        header("location: Profile.php");
    }
    ?>
</body>
</html>