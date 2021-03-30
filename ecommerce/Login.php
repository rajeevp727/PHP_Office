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
<h1><marquee direction="right">Login Page</marquee></h1>

<?php
include "DB_Connect.php";
$userName = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!empty($_POST['userName'])){$userName = $_POST['userName'];}
	else{ "<script>alert('User Name field cannot be left blank');</script>"; }
	if(!empty($_POST['password'])){$password = $_POST['userName'];}
	else{ "<script>alert('Password field cannot be left blank');</script>"; }

	if(isset($_POST['btnLogin'])){
		// try{
			$stmnt_login = $conn->prepare("SELECT * from users WHERE userName=:userName and password=:pass");
			$stmnt_login->bindParam(":userName", $userName);
			$stmnt_login->bindParam(":pass", $password);
			$stmnt_login->execute();
			$countUsers = $stmnt_login->rowCount();
			if($countUsers > 1 || $countUsers= 1){
			try{
			$stmnt_users = $conn->prepare("SELECT * FROM users where userName=:userName");
			$stmnt_users->execute([":userName"=>$userName]);
			header("location: Profile.php");
			while($rows = $stmnt_users->fetch(PDO::FETCH_ASSOC)){
				$_SESSION['user']  = $userName;
			}	
		}catch(PDOException $e){ echo "error: ".$e->getMessage(); }
		} else{ echo "<script>alert('Could not fetch records, Try again');</script>"; }
		// 
	}
}
?>

<div class="signup-form">
    <form name="frmReg" action="#" method="post">
		<!-- <h2>Login</h2> -->
		<p class="hint-text">Login to your your account.</p>
		<div class="form-group">
            <input type="text" class="form-control" name="userName" placeholder="Enter your username" required autofocus>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="pass" placeholder="Enter your Password" required>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnLogin">Login</button>
        </div>
    </form>
	<div class="text-center">Don't have an account? <a href="Registration.php">Register here</a></div>
</div>
<script>
$()
</script>
</body></html>