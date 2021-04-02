<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>

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
          			<span class="align-middle">Ecommerce project</span>
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
						<a href="#Prod" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categories</span>
						</a>
						<ul id="Prod" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="addCateg.php">Add Categories</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="editcateg.php">List Categories</a></li>
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
<?php
$ProdName = $ProdDesc = "";
include "DB_Connect.php";
if($_SERVER["REQUEST_METHOD"] =="POST"){
        if(!empty($_POST['ProdName']) || !empty($_POST['ProdDesc'])){
            $ProdName = trim($_POST['ProdName']);
            $ProdDesc = trim($_POST['ProdDesc']);
            $prodPrice = $_POST['ProdPrice'];
        if(isset($_POST['btnAddProd'])){
            try{
            $sql_Prod_add = $conn->prepare("INSERT INTO `Products`(`ProdName`, `ProdDesc`, `prodPrice`) VALUES (:Prodname, :ProdDesc, :prodPrice)");
            $sql_Prod_add->execute([":Prodname"=>$ProdName, ":ProdDesc"=>$ProdDesc, ":prodPrice"=>$prodPrice]);
            }catch(PDOException $e){ echo "error".$e->getMessage(); }
    
            header("location: listProd.php");
        }
    } else{ echo "<script>alert('Fields cannot be empty');</script>";}
    if(isset($_POST['btnCancel'])){
        header("location: listProd.php");
    }
}
?>
<div class="main">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Add Products here</h1>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p><span style="color:red">*</span> Only admin can Add NEW Products</p>
                                <div class="m-sm-4">
                                    <div class="text-center">
                                    </div>
                                    <form method="post">
                                        <div class="mb-3">
                                            <input class="form-control form-control-lg" type="text" name="ProdName" placeholder="Name your Product" autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="ProdDesc" style="width:100%;" rows="5" placeholder="Describe your Product"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-lg" type="number" name="ProdPrice" placeholder="Price"/>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary" name=btnAddProd>Add Product</button>
                                            <button type="submit" class="btn btn-lg btn-primary" name=btnCancel>Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<script src="app.js"></script>

</body>
</html>