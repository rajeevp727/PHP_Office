<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
include "DB_Connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Profile - "<?php echo $_SESSION['user']; ?>"</title>
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
<?php 
$fname = $lname = $email = $userName = $pass = $confPass = "";
if(isset($_SESSION['user'])){ 
    
    ?>
<h1>User <i>"<?php echo $_SESSION['user']; ?>" Profile</h1>
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
    <tr><td style="width:50%;">First Name</td><td><input type="text" name="fname" value=<?php echo $fname; ?>></td></tr>
    <tr><td>Last Name</td><td><input type="text" name="lname" value=<?php echo $lname; ?>></td></tr>
    <tr><td>Email</td><td><input type="text" name="email" value=<?php echo $email; ?>></td></tr>
    <tr><td>User Name</td><td><input type="text" name="userName" value=<?php echo $userName; ?>></td></tr>
    <tr><td>Password</td><td><input type="password" name="pass" value=<?php echo $pass; ?>></td></tr>
    <tr><td>Confirm Password</td><td><input type="password" name="confPass" value=<?php echo $confPass; ?>></td></tr>
</table> <br>
    </div>
    <input type="submit" value="Save Edit" name="btnSaveEdit" style="background-color:#66ff99; width:49%; float:left;cursor:pointer;">
    <input type="submit" value="Cancel Edit" name="btnCancelEdit" style="background-color:#ed736b; width:49%; float:right;cursor:pointer;">
    </form>
    
    <?php
    if(isset($_POST['btnSaveEdit'])){
        try{
            $sql_saveEdit = $conn->prepare("UPDATE users SET fName=:fname, lName=:lname, email=:email,
                    userName=:userName, password=:pass, confirmPassword=:confPass WHERE fName=:fname");
            $sql_saveEdit->bindParam(":fname", $_POST['fname']);        
            $sql_saveEdit->bindParam(":lname", $_POST['lname']);        
            $sql_saveEdit->bindParam(":email", $_POST['email']);        
            $sql_saveEdit->bindParam(":userName", $_POST['userName']);        
            $sql_saveEdit->bindParam(":pass", $_POST['pass']);        
            $sql_saveEdit->bindParam(":confPass", $_POST['confPass']);        

            $sql_saveEdit->execute();
            
            header("location: profile.php");
        } catch(PDOException $e){ echo "error ".$e.getMessage(); }
    }
    if(isset($_POST['btnCancelEdit'])){
        header("location: Profile.php");
    }
    ?>
<?php }else{ 
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>  
</body>
</html>