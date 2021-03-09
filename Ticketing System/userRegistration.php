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

<?php 
include "db_connect.php";
if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();  }

$username = $password = $email = "";
$usernameErr = $passwordErr = $emailErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["username"])){ $usernameErr = "Username is required";}
    else{ $username = trim($_POST["username"]); }

if(empty($_POST["password"])){ $passwordErr = "Password is required";}
    else{ $password = trim($_POST["password"]); }

if(empty($_POST["email"])){ $emailErr = "Email is required";}
else{ $email = trim($_POST["email"]); }

    if(isset($_POST['btnRegister'])){
    if(!((empty($username) || empty($password) || empty($email)))){    
    try{
    $sqlDuplicates = $conn->prepare("SELECT * from usrregistration WHERE username=:username");
    $sqlDuplicates->bindParam(':username',$username );
    $sqlDuplicates->execute();

    $rows = $sqlDuplicates->fetchAll();
    $count = count($rows);
    if($count >= 1){ echo "<script>alert('User already exists, try again with DIFFERENT USERNAME');</script>";  }
    elseif($count==0){
    echo "<script type=text/javascript>alert('User doesnt exist, creating new user')</script>";
    $stmnt = $conn->prepare("INSERT INTO usrregistration(`username`, `password`, `email`) VALUES(:username, :password, :email)");
    $stmnt->bindParam(':username',$username);
    $stmnt->bindParam(':password',$password);
    $stmnt->bindParam(':email',$email);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmnt->execute();

    echo "<script>alert('Registered Successfully')</script>";
    echo "<script>alert('New session started')</script>";
    header("location: Login.php");
    }
    // }catch(PDOException $e){echo "".$e->getMessage;}
    } catch(PDOException $e){ echo "Error: " . $e->getMessage(); }
    }else{ echo "<script>alert('Fields cannot be empty')</script>"; }
}else{ echo "<script>alert('Invalid ');</script>"; }
}
?>

<h1>Registration Page</h1>
<form action="#" method="post" name = "frmRegister">
<input type="text" name="username" placeholder="Enter your Username"><span class = "error">*<?php echo $usernameErr; ?></span><br>
<input type="text" name="password" placeholder="Enter your Pasword"><span class = "error">*<?php echo $passwordErr; ?></span><br>
<input type="text" name="email" placeholder="Enter your Email"><span class = "error">*<?php echo $emailErr; ?></span> <br>
<input type="submit" value="Register" name = "btnRegister">
</form>

</body>
</html>