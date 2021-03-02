<!DOCTYPE html>
<html lang="en">
<head>
 <title>Ticketing System - Registration</title>
 <style>
 .error {color: red;}
 h1{ text-align : center; }
 </style>
</head>
<body>

<?php include "db_connect.php";

$username = $password = $email = "";
$usernameErr = $passwordErr = $emailErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["username"])){ $usernameErr = "Username is required"; echo "<script>alert('Username cannot be empty...')</script>";}
    else{ $username = trim($_POST["username"]); }

if(empty($_POST["password"])){ $passwordErr = "Password is required"; echo "<script>alert('Password cannot be empty...')</script>";}
    else{ $password = trim($_POST["password"]); }

if(empty($_POST["email"])){ $emailErr = "Email is required"; echo "<script>alert('Email cannot be empty...')</script>";}
    else{ $email = trim($_POST["email"]); }
}

if(!empty($_POST['username'])) {
    // print_r($_POST);
    // exit();
    if(!((empty($username) || empty($password) || empty($email)))){    
    try{
    $stmnt = $conn->prepare("INSERT INTO usrregistration(`username`, `password`, `email`) VALUES(:username, :password, :email)");
    $stmnt->bindParam(':username',$username);
    $stmnt->bindParam(':password',$password);
    $stmnt->bindParam(':email',$email);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmnt->execute();
    // session_start();
    echo "<script>alert('new session started')</script>";
    // $_SESSION['sess_username'] = $username;
    // $_SESSION['sess_password'] = $password;
    echo "<script>alert('Registered Successfully..')</script>";
    $conn = null;
    } catch(PDOException $e){ echo "Error: " . $e->getMessage; }
    header("location: Login.php");
    }    
    else{ echo "<script>alert('Fields Cannot be empty')</script>"; }
}
?>
<h1>Registration Page</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<input type="text" name="username" placeholder="Enter your Username"><span class = "error">*<?php echo $usernameErr; ?></span><br>
<input type="text" name="password" placeholder="Enter your Pasword"><span class = "error">*<?php echo $passwordErr; ?></span><br>
<input type="text" name="email" placeholder="Enter your Email"><span class = "error">*<?php echo $emailErr; ?></span> <br>
<input type="submit" value="Register" >
</form>

</body>
</html>