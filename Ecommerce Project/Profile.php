<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<!DOCTYPE html>
<body>
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
							
							<?php if(isset($_SESSION['user'])) { ?>
							<li class="sidebar-item"><a class="sidebar-link" href="Profile.php">Profile</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="Logout.php">Logout</a></li>
							<?php } else{ ?>
							<li class="sidebar-item"><a class="sidebar-link" href="Login.php">Login</a></li>
								
							<?php }?>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div class="main">  
			<main class="d-flex w-100">
				<?php 
				if(isset($_SESSION['user'])){
					$username = $_SESSION['user'];
					$conn = mysqli_connect("localhost", "root", "", "ecommerce");
				$sql = "SELECT * FROM users WHERE userName='$username'";

				$userDetails = mysqli_query($conn, $sql);
				$fetchUSers = mysqli_fetch_assoc($userDetails);
				?>
					<div class="container d-flex flex-column">
						<div class="row vh-100">
							<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
								<div class="d-table-cell align-middle">
									<div class="text-center mt-4">
										<h1 class="h2">User "<?php echo $_SESSION['user']?>" Profile</h1>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="m-sm-4">
												<div class="text-center">
												</div>
												<form method="post">
													<div class="mb-3">
														<!-- <input class="form-control form-control-lg" type="text" name="id" readonly value= <?php // echo $fetchUSers['id']; ?> > -->
													</div>    
													<div class="mb-3">
														<span>First Name</span>
														<input class="form-control form-control-lg" type="text" name="fName" readonly value= <?php echo $fetchUSers['fName']; ?> >
													</div>
													<div class="mb-3">
													<span>Last Name</span>
														<input class="form-control form-control-lg" type="text" name="lName" readonly value= <?php echo $fetchUSers['lName']; ?> >
													</div>
													<div class="mb-3">
													<span>Email</span>
														<input class="form-control form-control-lg" type="text" name="email" readonly value= <?php echo $fetchUSers['email']; ?> >
													</div>
													<div class="mb-3">
													<span>User Name</span>
														<input class="form-control form-control-lg" type="text" name="userName" readonly value=<?php echo $fetchUSers['userName']; ?> >
													</div>
													<div class="mb-3">
													<span>Password</span>
														<input class="form-control form-control-lg" type="text" name="pass" readonly value=<?php echo $fetchUSers['password']; ?> >
													</div>
													<div class="mb-3">
													<span>Confirm Password</span>
														<input class="form-control form-control-lg" type="text" name="confPass" readonly value=<?php echo $fetchUSers['confirmPassword']; ?> >
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				<?php		} else { echo "Invalid User Session, try <a href=Login.php>  Logging in </a> again"; }				?>
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
</body>
</html>