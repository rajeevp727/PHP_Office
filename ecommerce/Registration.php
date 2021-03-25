<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>User Registration</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 100px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 0%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>

<script type="text/javascript">
    function validateEmail(){
        var email = document.getElementById("email").value;
        var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;; 
}
</script>
</head>

<body>
<?php
include "DB_Connect.php";
$fname = $lname = $email = $userName = $pass = $confPass = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!empty($_POST['first_name'])){
		$fname = $_POST['first_name'];
	} else { echo "<script>alert('First Name field cannot be left blank');</script>"; }
	if(!empty($_POST['last_name'])){
		$lname = $_POST['last_name'];
	} else { echo "<script>alert('Last Name field cannot be left blank');</script>"; }
	if(!empty($_POST['email'])){		
		$email = $_POST['email'];
	} else { echo "<script>alert('Email field cannot be left blank');</script>"; }
	if(!empty($_POST['userName'])){		
		$userName = $_POST['userName'];
	} else { echo "<script>alert('User Name field cannot be left blank');</script>"; }
	if(!empty($_POST['password'])){		
		$pass = $_POST['password'];
	} else { echo "<script>alert('Password field cannot be left blank');</script>"; }
	if(!empty($_POST['confirm_password'])){
		$confPass = $_POST['confirm_password'];
	} else { echo "<script>alert('Confirm Password field cannot be left blank');</script>"; }
	
	//iNSERT Data into DB
	if(isset($_POST['btnRegister'])){
		if($pass == $confPass){
		try{ 
			$duplicates = $conn->prepare("SELECT * FROM USERS where fName=:fname");
			$duplicates->execute([":fname"=>$fname]);
			$res = $duplicates->fetchAll();
			$count = count($res);
			if($count>=1){   echo "<script>alert('User already exists, try again with DIFFERENT User Name');</script>";   }
			elseif($count == 0){ echo "<script>alert('Creating new User:'.$fName)</script>" ; 

			// Insert Data into DB
			$stmnt_reg=$conn->prepare("INSERT INTO users(fName, lName, email,  userName, password, confirmPassword) VALUES(:fName, :lName, :email, :userName, :pass, :confPass)");	 
			$stmnt_reg->bindParam(":fName", $fname);
			$stmnt_reg->bindParam(":lName", $lname);
			$stmnt_reg->bindParam(":email", $email);
			$stmnt_reg->bindParam(":userName", $userName);
			$stmnt_reg->bindParam(":pass", $pass);
			$stmnt_reg->bindParam(":confPass", $confPass);
			$stmnt_reg->execute();
			echo "<script>alert('Data Successfully inserted');</script>";

			header("location: Login.php");
			}
		}catch(PDOException $e){ echo "error".$e->getMessage();}
	}else{  echo "<script>alert('password and Confirm Passwords Dont match, try again');</script>";  }
	}
}
?>
	<h1><marquee direction="right">Registeration Page</marquee></h1>

<div class="signup-form">
    <form name="frmReg" action="#" method="post" onSubmit="return validateEmail()">
		<p class="hint-text">Create your account in a minute.</p>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="first_name" placeholder="Enter your First Name"></div>
				<div class="col"><input type="text" class="form-control" name="last_name" placeholder="Enter your Last Name"></div>
			</div>
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="email" placeholder="Enter your Email" onkeyup="validateEmail()">
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="userName" placeholder="Choose a username">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Choose a Password">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your Password">
        </div>        
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnRegister" >Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="Login.php">Login</a></div>
</div>

</body></html>