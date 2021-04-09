<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe Keys - <?php if(isset($_SESSION['user'])){
			echo $_SESSION['user'];
	}?></title>
    <link rel="stylesheet" href="app.css">
	<link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
 <!-- for Data Table using JQUERY-->


<body>
	<?php 
// ------------- Using mYSQLI
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

		if($pass == $confPass){ 
		$sql = "INSERT INTO createusers(fName, lName, email, password, phone, address, status) 
 					VALUES ('$fname', '$lname', '$email', '$pass', '$phone', '$address', '$status')";
		$craeteUSers = mysqli_query($conn, $sql); 
		echo "<script>alert(Insert Failed);</script>";
		if($craeteUSers){ 
			header("location: Dashboard.php");
		}else{ echo "<script>alert(Insert Failed);</script>"; }
	} else{ echo 11,"<script>alert(Password and Confirm Password donot match );</script>"; }
	mysqli_close($conn);
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
						<a href="#uers" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Users</span>
						</a>
						<ul id="uers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="createUsers.php">Add Uers</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="viewUsers.php">List Users</a></li>
						</ul>
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
							<li class="sidebar-item"><a class="sidebar-link" href="addProd.php">Add Products</a>
							<li class="sidebar-item"><a class="sidebar-link" href="listProd.php">List Products</a>
						</ul>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="Profile.php">
              				<i class="align-middle" data-feather="users"></i> <span class="align-middle">Profile</span>
            			</a>
					</li>	

					<li class="sidebar-item">
						<a class="sidebar-link" href="Logout.php">
              				<i class="align-middle" data-feather="key"></i> <span class="align-middle">Logout</span>
            			</a>
					</li>	
					
					</li>
				</ul>
			</div>
		</nav>
		<div class="main">   
		<main class="d-flex w-100"> 
			<div class="container d-flex flex-column">
			<a class="sidebar-toggle d-flex">
          	<i class="hamburger align-self-center"></i>
        </a>
				<h3><?php if(isset($_SESSION['user'])){ echo "User";  }
					else{ echo ("Invalid User Session, try <a href=Login.php>  Logging in</a>"); } ?>
				<strong><?php if(isset($_SESSION['user'])){ echo $_SESSION['user'];  ?>
				</strong> Stripe Page</h3>
				<?php } else { echo ""; } ?>
				<div class="d-table-cell align-middle">
				<div class="text-center mt-4">
				</div>
				<div class="card">
					<div class="card-body">
						<div class="m-sm-4">
							<form method="post">
                                <div class="mb-3">
                                    <label for="publicKey">Public Key</label>
                                    <input class="form-control form-control-lg" type="text" name="publicKey">
                                </div>
                                <div class="mb-3">
                                    <label for="privateKey">Private Key</label>
                                    <input class="form-control form-control-lg" type="text" name="privateKey">
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</main>
		
		<footer class="footer" style="position:fixed; bottom:0px; width:77%;">
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
	<script src="app.js"></script>

</body>
</html>