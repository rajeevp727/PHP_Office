<!DOCTYPE html>
<html lang="en">
<head>
   <title>Ticketing System - Login</title>
   <style>
   .error { color: red; }
   h1{ text-align : center; }
   </style>
</head>
<body>
<?php
    $uname = $pass = "";
    $unameErr = $passErr = "";
    $sessUser = "";
?>
    <h1>User Login </h1>
    <?php 
    session_start();
    $sessUser = $_SESSION['username'];
    if(!empty(session_status())){
    if(session_status() == 0){ echo "The  session[$sessUser] is currently : Disabled"; }
    else if (session_status() == 1){ echo "The session[$sessUser] is currently : None"; }
    elseif(session_status() == 2){ echo "The session[$sessUser] is currently : Active"; } 
    }
    else{ echo "The session is currently : Unknown";}
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> <br>
        <input type="text" name="uname" placeholder="Enter your username"><span class="error">*<?php echo $unameErr; ?></span> <br>
        <input type="text" name="pass" placeholder="Enter your password"><span class="error">*<?php echo $passErr; ?></span> <br>
        <input type="submit" value="Login" name="btnLogin">
        <input type="submit" value="Registser" name = "btnReg"> 
    </form>
    <?php
    include('db_connect.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){        
    if(empty($_POST['uname'])){ $unameErr = "Username is required";}
    else{ $uname = trim($_POST['uname']); }
    if(empty($_POST['pass'])){ $passErr = "Password is required";}
    else{ $pass = trim($_POST['pass']); }

    if(isset($_POST['btnLogin'])){  

    if(!((empty($uname)) || (empty($pass)))){
    try{
    $stmnt = $conn->prepare("SELECT * FROM `usrregistration` where `username` = :username and `password` = :password");
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $stmnt->execute([ ':username' => $uname, ':password' => $pass ]);

    $count = $stmnt->rowCount();
    $row = $stmnt->fetch(PDO::FETCH_ASSOC);
    
    if($count == 1 || $count > 0){
        // Session data
        $_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_pswrd'] = $row['password'];
        $sessName = $_SESSION['sess_username'];
     
    if(isset($_POST['uname']) && isset($_POST['pass'])){
        if(($uname == "admin") && ($pass == "admin")){ echo "<script>alert('Welcome - ADMIN')</script>"; }  
        if(!empty($uname) && !empty($pass)){ echo "<script>alert('Welcome - user: $uname')</script>"; }
        else{ echo "<script>alert('Invalid username/password.. Try again later');</script>"; }
    }
    }
    else{
        echo "<script>alert('Could not fetch records, Try again');</script>";
        exit();  }
    $_SESSION['sess_username'] = $uname;
    $_SESSION['sess_password'] = $pass;

    header("location: homePage.php");
    }catch(PDOException $e){ echo "error: " . $e->getMessage();  }
    }else{ echo "<script>alert('Fields cannot be empty..')</script>"; }
}
if(isset($_POST['btnReg'])){ session_destroy(); header("location: userRegistration.php");  }
}
?>
</body>
</html>