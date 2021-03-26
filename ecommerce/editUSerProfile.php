<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
include "DB_Connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Profile - <?php echo $_SESSION['user']; ?></title>
</head>
<body>
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
    <table border=1px style="border-collapse: collapse">
    <tr><td>First Name</td><td><input type="text" value=<?php echo $fname; ?>></td></tr>
    <tr><td>Last Name</td><td><input type="text" value=<?php echo $lname; ?>></td></tr>
    <tr><td>Email</td><td><input type="text" value=<?php echo $email; ?>></td></tr>
    <tr><td>User Name</td><td><input type="text" value=<?php echo $userName; ?>></td></tr>
    <tr><td>Password</td><td><input type="password" value=<?php echo $pass; ?>></td></tr>
    <tr><td>Confirm Password</td><td><input type="password" value=<?php echo $confPass; ?>></td></tr>
</table>
    </div>
    <input type="submit" value="Save Edit" name="btnSaveEdit">
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
    ?>
</body>
</html>