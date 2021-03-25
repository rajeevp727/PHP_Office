<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>

<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>User Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="Login.css">
</head>

<body>
<?php
include "DB_Connect.php";
$userName = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!empty($_POST['userName'])){$fname = $_POST['userName'];}
	else{ "<script>alert('User Name field cannot be left blank');</script>"; }
	if(!empty($_POST['password'])){$password = $_POST['userName'];}
	else{ "<script>alert('Password field cannot be left blank');</script>"; }

	if(isset($_POST['btnLogin'])){
		try{
			$stmnt_login = $conn->prepare("SELECT * from users WHERE fName=:fname and password=:pass");
			$stmnt_login->execute([":fname"=>$fname, ":pass"=>$password]);
			echo "<script>alert('Login SUccessful');</script>";
			$_SESSION['user']  = $fname;
			header("location: Profile.php");
		}catch(PDOException $e){ echo "error: ".$e->getMessage(); }
	}
}
?>
	<h1><marquee direction="right">Login Page</marquee></h1>

<div class="signup-form">
    <form name="frmReg" action="#" method="post">
		<!-- <h2>Login</h2> -->
		<p class="hint-text">Login to your your account.</p>
		<div class="form-group">
            <input type="text" class="form-control" name="userName" placeholder="Enter your username" required>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your Password" required>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnLogin">Login</button>
        </div>
    </form>
	<div class="text-center">Don't have an account? <a href="Registration.php">Register here</a></div>
</div>

</body></html>