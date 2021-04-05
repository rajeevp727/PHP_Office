<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Users</title>
</head>
<body>
<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create NEW users</title>
    <link rel="stylesheet" href="app.css">
	<link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
 <!-- for Data Table using JQUERY-->


<body>
	<?php 
	if(isset($_POST['userCreate'])){ 
		$conn = mysqli_connect("localhost","root","","ecommerce");

		$fname =$_POST['fName']; 
		$lname = $_POST['lName'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$confPass= $_POST['confPass']; 
		$phone = $_POST['phone']; 
		$address = $_POST['address']; 
		$status = $_POST['status']; 
		
		if(!empty($fname) || !empty($lname) || !empty($email) || !empty($fname) )
		if($pass == $confPass){ 
		$sql = "INSERT INTO createusers(fName, lName, email, password, phone, address, status) 
 					VALUES ('$fname', '$lname', '$email', '$pass', '$phone', '$address', '$status')";
		$craeteUSers = mysqli_query($conn, $sql); 
		echo "<script>alert(Insert Failed);</script>";
		if($craeteUSers){ 
			header("location: Dashboard.php");
		}else{ echo "<script>alert(Insert Failed);</script>"; }
	} else{ echo 11,"<script>alert(Password and Confirm Password donot match );</script>"; }
	// mysqli_close($conn);
}

if(isset($_POST['btnCancel'])){
	header("location: dashboard.php");
}
	?>
    <div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="Dashboard.php">
          			<span class="align-middle">Ecommerce Project</span>
        		</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="Dashboard.php">
              				<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            			</a>
					</li>	

					<li class="sidebar-item">
						<a href="#categ" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categories</span>
						</a>
						<ul id="categ" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="addCateg.php">Add Categories</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listCateg.php">List Categories</a></li>
						</ul>
					</li>
					
					<li class="sidebar-item">
						<a href="#prod" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Products</span>
						</a>
						<ul id="prod" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="addProd.php">Add Products</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listProd.php">List Products</a></li>
						</ul>
					</li>


					<li class="sidebar-item">
						<a href="#userActions" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">User Actions</span>
						</a>
						<ul id="userActions" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<?php if(isset($_SESSION['user'])){ ?>
							<li class="sidebar-item"><a class="sidebar-link" href="Profile.php">Profile</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="Logout.php">Logout</a></li>
							<?php }else{ ?>
							<li class="sidebar-item"><a class="sidebar-link" href="Login.php">Login</a></li>

								<?php } ?>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div class="main">    
		<main class="d-flex w-100"> 
			<div class="container d-flex flex-column">
			<h3><?php if(isset($_SESSION['user'])){ echo "User";  }
						else{ echo ("Invalid User Session, try <a href=Login.php>  Logging in</a>"); } ?>
								<strong><?php if(isset($_SESSION['user'])){ echo $_SESSION['user'];  ?>
								</strong> Add Users</h3>
								<?php } else { echo ""; } ?>
						<div class="d-table-cell align-middle">
							<?php	if(isset($_SESSION['user']) == "admin"){ 
								
							$username= $_SESSION['user'];
							$conn = mysqli_connect("localhost", "root", "", "ecommerce");
							$sql = "SELECT * FROM createusers ORDER BY id DESC";

							$getUsers = mysqli_query($conn, $sql);
							$users = mysqli_fetch_assoc($getUsers);								
							?>
								<div class="text-center mt-4">
								</div>
								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<div class="text-center">
								</div>
									<form action="" method="post">
										<h3>Here you can create new Users</h3>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="text" name="fName" placeholder="Enter First Name" autofocus  >
										</div><div class="mb-3">
											<input class="form-control form-control-lg" type="text" name="lName" placeholder="Enetr Last Name"  >
										</div><div class="mb-3">
											<input class="form-control form-control-lg" type="text" name="email" placeholder="Enetr Email"  onBlur="ValidateEmail(this);">
										</div><div class="mb-3">
											<input class="form-control form-control-lg" type="text" name="pass" placeholder="Enetr Password">
										</div><div class="mb-3">
											<input class="form-control form-control-lg" type="text" name="confPass" placeholder="Enter Confirm Password" >
										</div><div class="mb-3">
											<input class="form-control form-control-lg" type="number" length=10 name="phone" placeholder="Enter Phone Number"  >
										</div><div class="mb-3">
											<textarea class="form-control form-control-lg" name="address" rows=5  placeholder="Enetr Address"  ></textarea>
										</div><div class="mb-3">
											<select calss="form-control form-control-ig" name="status" style="width:100%;">
												<option value="Active">Active</option>
												<option value="inActive">inActive</option>
											</select>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="userCreate">Create User</button>
											<button type="submit" class="btn btn-lg btn-primary" name="btnCancel">Cancel</button>
										</div>
										<div class="text-center mt-3">
											
										</div>
									</form>
										</div>
										</div>
									</div>
								</div>
						<?php	} else{  echo "<script>alert('Only ADMIN can create new users');</script>";}	?>
			</div>
		</main>
			<footer class="footer" style="position:absolute; bottom:0px; width:77%;">
				<div class="container-fluid">
					<div class="row text-muted">
		                <div class="col-6 text-start">
                            <p class="mb-0">
		    	                <a href="index.html" class="text-muted"><strong>Ecommerce Project</strong></a> &copy;
		                    </p>
		                </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms & Conditions</a>
                                </li>
                            </ul>
			            </div>
			        </div>
			    </div>
        </footer>
        </div>

       

    </div>
	<script src="app.js"></script>
<script>
	function ValidateEmail(email){
		pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(pattern.test(email.value) == false){
			alert("Invalid Emial Format");
			return false;
		}
		return true;
	}
</script>
</body>
</html>
</body>
</html>