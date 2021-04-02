<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View users</title>
    <link rel="stylesheet" href="app.css">
	<link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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
		<?php
		if(isset($_POST['btnCancel'])){
			header("location: Dashboard.php");
		}
		?>
		<main class="d-flex w-100"> 
			<div class="container d-flex flex-column">

			<h3><?php if(isset($_SESSION['user'])){ echo "User";  }
						else{ echo ("Invalid User Session, try <a href=Login.php>  Logging in</a>"); } ?>
								<strong><?php if(isset($_SESSION['user'])){ echo $_SESSION['user'];  ?>
								</strong> View</h3>
								<?php } else { echo ""; } ?>

			
						<div class="d-table-cell align-middle">
							<?php	if($_SESSION['user'] == "admin"){ 
								
							$username= $_SESSION['user'];
							$conn = mysqli_connect("localhost", "root", "", "ecommerce");
							$sql = "SELECT * FROM createusers ORDER BY id DESC";

							$getUsers = mysqli_query($conn, $sql);
							?>
								<div class="text-center mt-4">
								</div>
								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<div class="text-center"></div>
									<form action="" method="post">
										<div class="mb-3">
											<h3>View</h3>
											<table id="showUsers" class="display" style="width:100%">
												<thead>
													<tr>
														<th>ID</th>
														<th>First Name</th>
														<th>Last Name</th>
														<th>Email</th>
														<th>Password</th>
														<th>Phone</th>
														<th>Address</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>

													<?php  
													$i=0;
													while($rows = mysqli_fetch_assoc($getUsers)) { 
														$i++ ?>
													<tr>
														<td>
															<?php echo $i; ?>	
														</td>
														<td>
															<?php echo $rows['fName']; ?>	
														</td>
														<td>
															<?php echo $rows['lName']; ?>	
														</td>
														<td>
															<?php echo $rows['email']; ?>	
														</td>
														<td>
															<?php echo $rows['password']; ?>	
														</td>
														<td>
															<?php echo $rows['phone']; ?>	
														</td>
														<td>
															<?php echo $rows['address']; ?>	
														</td>
														<td>
															<?php echo $rows['status']; ?>	
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="btnCancel">Go to dashboard</button>
									</form>
										</div>
										</div>
									</div>
								</div>
						<?php	} else{  echo "Only ADMIN can create new users";}	?>
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
    $(document).ready(function() {
        $('#showUsers').DataTable();
    });
    </script>
</body>
</html>