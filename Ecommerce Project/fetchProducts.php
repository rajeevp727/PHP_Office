<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products under <?php echo $_GET['categ']; ?></title>

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <style>
    #btnCancel{
        bottom: 0px;
        left : 0px;
        width:100%;
    }
    </style>
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
    <?php
    $categName = $categDesc = "";
    include "DB_Connect.php";
    if($_SERVER["REQUEST_METHOD"] =="POST"){
        if(isset($_POST['btnCancel'])){
            header("location: listCateg.php");
        }
    }
    ?>
      <div class="main">
		<main class="d-flex w-100"> 
            <div class="container d-flex flex-column">
            <a class="sidebar-toggle d-flex">
          	    <i class="hamburger align-self-center"></i>
            </a>
                <h1>Products under the Category:  <?php echo $_GET['categ']; ?></h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center"></div>
                                <?php
                                if(isset($_SESSION['user'])){
                                if(isset($_GET['categ'])){     
                                  $categ = $_GET['categ']; 
                                $conn = mysqli_connect("localhost", "root", "", "ecommerce"); 
                                $sql = "SELECT * FROM products WHERE products.belongsToCateg = '$categ'";
                                // $sql = "SELECT * from products INNER JOIN categories on products.belongsToCateg = categories.categName";
                                $result = mysqli_query($conn, $sql); 
                                // $sqlData = mysqli_fetch_assoc($res);
                                ?>
                                <form method="post">
                                <table id="tblfetchProds" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i=0;
                                        while($sqlData = mysqli_fetch_assoc($result)) {
                                            $i++; ?>
                                            <tr>
                                        <?php if(!empty($sqlData['belongsToCateg'])){ ?>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $sqlData['prodDesc']; ?></td>
                                            <td><?php echo $sqlData['prodName']; ?></td>
                                            <td><?php echo $sqlData['prodPrice']; ?></td>
                                            <?php } else { echo ""; }?>
                                        </tr>
                                        <?php   }  ?>
                                    </tbody>
                                </table> <br> <br>  
                                <div class="text-center mt-3">
                                <button type="text" id="btnCancel" class="btn btn-lg btn-primary" name="btnCancel">Go Back to the List of Categories</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php  } else{ echo "<script>alert(Invalid, Try again);</script>"; }
                 } else{ echo "<script>alert('User Doesnot exist');</script>"; } ?>
        </main>

        <footer class="footer" style="position:absolute; bottom: 0px; width:77%;">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-112 text-start">
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

<script>
$(document).ready(function(){
    $('#tblfetchProds').DataTable();
});
</script>

</body>
</html>