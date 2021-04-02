<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Products</title>

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<!DOCTYPE html>
<body>
    <?php if(isset($_SESSION['user'])){ ?>
        
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
<?php
$categName = $categDesc = "";
include "DB_Connect.php";
if($_SERVER["REQUEST_METHOD"] =="POST"){
        if(!empty($_POST['categName']) || !empty($_POST['categDesc'])){
            $categName = trim($_POST['categName']);
            $categDesc = trim($_POST['categDesc']);
        if(isset($_POST['btnAddCateg'])){
            try{
            $sql_categ_add = $conn->prepare("INSERT INTO `categories`(`categName`, `categDesc`) VALUES (:categname, :categDesc)");
            $sql_categ_add->execute([":categname"=>$categName, ":categDesc"=>$categDesc]);
            echo "<script>alert('New category created');</script>";
            }catch(PDOException $e){ echo "error".$e->getMessage(); }
    
            header("location: listCateg.php");
        }
    } else{ echo "<script>alert('Fields cannot be empty');</script>";}
    if(isset($_POST['btnCancel'])){
        header("location: DashBoard.php");

    }
}
?>
<div class="main">
        <div class="container d-flex flex-column">
            <h1 class="h2">Your Products here</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <p><span style="color:red">*</span> Only admin can Add NEW Products</p>
                <div class="m-sm-4">
                    <div class="text-center">
                    </div>
                    <form method="post">
                                      
                        <?php if($_SESSION['user'] == "admin"){  
                            echo "<a class=add href=addProd.php style=font-size:16px; background-color:green;>Add Product</a>";   ?>

                        <table id="tblProd1" class="table table-striped table-bordered" style="border-collapsed:collapsed; width:100%">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>    
                        <?php $i=0;
                        $countProdRows = 0;
                        $stmnt_prod = $conn->prepare("SELECT * FROM products order by id ASC");
                        $stmnt_prod->execute();
                        
                        while($rows = $stmnt_prod->fetch(PDO::FETCH_ASSOC)){ $i++;
                            $countProdRows = count($rows);
                            if($countProdRows >= 1){ 
                            echo "<tbody>".
                                 "<tr>".
                                 "<td>".$i."</td>".
                                 "<td>".$rows['id']."</td>".
                                 "<td>".$rows['prodName']."</td>".
                                 "<td>".$rows['prodDesc']."</td>".
                                 "<td>".$rows['prodPrice']."</td>".
                                 "<td><a class=add href=editProd.php?id=$rows[id] style=background-color: cyan;>Edit Product</a></td>".
                                 "<td><a class=add href=deleteProd.php?id=$rows[id] style=background-color: red;>Delete Product</a></td></tr>".
                                 "</tbody>";
                                }
                        }?>
                        <?php }
                        elseif($_SESSION['user'] != "admin"){?> 
                            <table id="tblProd2" class="table table-striped table-bordered" style="border-collapsed:collapsed; width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                    <th>Product Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>    
                        <?php $j=0;
                        $countProdRows = 0;
                        $stmnt_prod = $conn->prepare("SELECT * FROM products order by id ASC");
                        $stmnt_prod->execute();
                        while($rows = $stmnt_prod->fetch(PDO::FETCH_ASSOC)){ $j++;
                            $countProdRows = count($rows);
                            if($countProdRows >= 1){
                            echo "<tbody><tr>".
                                 "<td>".$j."</td>".
                                 "<td>".$rows['id']."</td>".
                                 "<td>".$rows['prodName']."</td>".
                                 "<td>".$rows['prodDesc']."</td>".
                                 "<td>".$rows['prodPrice']."</td>".
                                 "<td><a class=add href=editProd.php?id=$rows[id] style=background-color: cyan;>Edit Product</a></td>".
                                 "<td><a class=add href=deleteProd.php?id=$rows[id] style=background-color: red;>Delete Product</a></td></tr>".
                                 "</tbody>";
                                }
                        }?>
                           <?php echo "<script>alert('Please reqeust your ADMIN to create a NEW Product');</script>"; 
                        }
                        ?>
                        </table> 
                    </form>
                </div>
            </div>
        </div>
        <?php } else{ 
            echo "<script>alert('User Doesnot exist');</script>";
            echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
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
    $(document).ready( function() {
    $('#tblProd1').DataTable();
    } );
</script>

<script>
    $(document).ready( function() {
    $('#tblProd2').DataTable();
    } );
</script>

</body>
</html>