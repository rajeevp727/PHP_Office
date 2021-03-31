<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Categories</title>

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<!DOCTYPE html>
<body>
	<?php print_r($_SESSION); ?>
    <?php if(isset($_SESSION['user'])){ ?>
        
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
            <h1 class="h2">Your Categories here</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <p><span style="color:red">*</span> Only admin can Add NEW Categories</p>
                <div class="m-sm-4">
                    <div class="text-center">
                    </div>
                    <form method="post">
                                      
                        <?php if($_SESSION['user'] == "admin"){
                            echo "<a class=add href=addCateg.php style=font-size:16px; background-color:green;>Add Category</a>"; 
                            }  ?>

                        <table style="width:100%">
                        <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </tr>

                        <?php
                        $countCategRows=0;
                        $stmnt_categ = $conn->prepare("SELECT * FROM categories order by id DESC");
                        $stmnt_categ->execute();
                            $i = 1;
                        while($rows=$stmnt_categ->fetch(PDO::FETCH_ASSOC)){
                        $countCategRows = count($rows);
                        if($countCategRows>=1){
                            echo "<tr></tr>".
                                "<td>".$i."</td>".
                                "<td>".$rows['categName']."</td>".
                                "<td>".$rows['categDesc']."</td>".
                                "<td><a class=edit href=editCateg.php?id=$rows[id] style=background-color: cyan;>Edit Category</a></td>".
                                "<td><a class=delete href=deleteCateg.php?id=$rows[id] style=background-color: red;>Delete Category</a></td>";
                        }
                        $i++;
                        }
                        if($_SESSION['user'] != "admin" && $countCategRows == 0){
                            echo "<script>alert('Please reqeust your ADMIN to create a NEW Product');</script>"; 
                        }
                        ?>
                        </table>  
                    </form>
                </div>
            </div>
        </div>
        <?php } else{ echo "<script>alert('User Doesnot exist');</script>"; } ?>
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

</body>
</html>