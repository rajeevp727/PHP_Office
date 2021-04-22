<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<?php
require "config/config.inc.php";
$title = "Login | E-Shopper";
include "header.php";
?>

<?php
if(isset($_POST['Register'])){
	if(!empty($_POST['RegName'])){ 
	$RegName = $_POST['RegName']; 
	$RegEmail = $_POST['RegEmailAddress'];
	$RegPassword = $_POST['password'];
	$regUser = mysqli_query($conn, "INSERT INTO users(name, email, password) VALUES('$RegName', '$RegEmail', '$RegPassword')");
	if($regUser){ 
		print_r($_POST);
		echo "Successfullly Registered, please login to continue";
		header("location: login.php");
	} else{ echo "Registration Falied, Try again";  }
} else{ echo "<script>alert('Fields cannot be empty');</script>"; }
}
if(isset($_POST['Login'])){
if(!empty($_POST['LoginName'])){
	$LoginName = $_POST['LoginName'];
	$LoginEmail = $_POST['LoginEmailAddress'];
	$loginUser = mysqli_query($conn, "SELECT * FROM users where email = '$LoginEmail'");
	if($loginUser){
		$_SESSION['user'] = $LoginName; echo $_SESSION['user'];
		echo "<script>
			  	alert('Logging in'); 
			  	window.location.href='index.php'
			  </script>";
	}
}else { echo 4; echo "<script>alert('Fields cannot be empty');</script>"; }
}
?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="post">
						<label for="LoginName">Name</label>
							<input type="text" name="LoginName" />
							<label for="LoginEmailAddress">Email</label>
							<input type="email" name="LoginEmailAddress" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<input type="submit" name="Login" class="btn btn-default" value="Login" style="background-color:orange;">
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post">
							<label for="RegName">Name</label>
							<input type="text" name="RegName"/>
							<label for="RegEmailAddress">Email</label>
							<input type="email" name="RegEmailAddress"/>
							<label for="password">Password</label>
							<input type="password" name="password"/>
							<input type="submit" name="Register" class="btn btn-default" value="Signup" style="background-color:orange;">
							<!-- <button type="submit" name="Register" class="btn btn-default">Signup</button> -->
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<?php include "footer.php"; ?>

</body>
</html>