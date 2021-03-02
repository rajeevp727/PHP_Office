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
?>
    <h1>User Login </h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> <br>
        <input type="text" name="uname" placeholder="Enter your username"><span class="error">*<?php echo $unameErr; ?></span> <br>
        <input type="text" name="pass" placeholder="Enter your password"><span class="error">*<?php echo $passErr; ?></span> <br>
        <input type="submit" value="Login" name="btnLogin">
    </form>
    <?php
    session_start();
    // echo session_status();

    // include('db_connect.php');
    // include('userRegistration.php');

    $sessName = $_SESSION['sess_username'];
    $sessPass = $_SESSION['sess_password'];    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['btnLogin'])){}
    if(empty($_POST['uname'])){ $unameErr = "Username is required";} // echo "<script>alert('Username cannot be blank')</script>"; }
    else{ $uname = trim($_POST['uname']); }
    if(empty($_POST['pass'])){ $passErr = "Password is required";} // echo "<script>alert('Password cannot be blank')</script>"; }
    else{ $pass = trim($_POST['pass']); }
    }
    
    if(isset($_POST['uname'])){
        print_r($_POST);
    try{
    $conn = new PDO("mysql:host=localhost; dbname=ticketingsystem", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlSelect = "SELECT * FROM `usrregistration` where `username` = :username and `password` = :password";
    $stmnt = $conn->prepare($sqlSelect);
    $stmnt->bindParam('username', $Usrname, PDO::PARAM_STR);
    $stmnt->bindParam('password', $pswd, PDO::PARAM_STR);
    $stmnt->execute();

    $count = $stmnt->rowCount();

    $row = $stmnt->fetch(PDO::FETCH_ASSOC);

    if($count ==1 && !empty($row)){
        // Session data
        $_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_pswrd'] = $row['password'];
        echo $_SESSION['sess_username'];
    } else {echo "<script>alert('Invalid Username or Password..')</script>" ; }

    if(isset($_POST['uname'])){
        if(!(empty($_POST['uname']) || empty($_POST['pass']))){
        if(($uname == 'admin') && ($pass == 'admin')){ echo "<script>alert('Welcome - ADMIN')</script>";  }    
        else if(($uname != 'admin') && ($pass != 'admin')){ echo "<script>alert('Welcome - user: $uname')</script>"; }
        else{ echo "<script>alert('Invalid username/password.. Try again later');</script>"; }
        }
    }
    }catch(PDOException $e){ echo "error: " . $e->getMessage();  }
    header("location: homePage.php");
}
    ?>
</body>
</html>