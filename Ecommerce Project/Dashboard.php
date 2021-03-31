<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="app.css">
	<link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
	<?php print_r($_SESSION); ?>
    <div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="Dashboard.php">
          			<span class="align-middle">Ecommerce Demo</span>
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
            <div class="container-fluid p-0">
                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><?php if(isset($_SESSION['user'])){ echo "User";?>
							"<strong><?php echo $_SESSION['user']; ?></strong>" Dashboard</h3>
						<?php } else{ echo "Invalid User Session, try Logging in again"; }	?>"
                    </div>
                </div>   
            </div> 
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