<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>List of Products</title>
    <link rel="stylesheet" href="app.css">
	<link href="app.css" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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

    <div class="main">
    <main class="d-flex w-100">
    <?php
    $categName = $categDesc = "";
    include "DB_Connect.php";
    ?>
    <?php if(isset($_SESSION['user'])){ ?>
    <div class="container d-flex flex-column">
        <a class="sidebar-toggle d-flex">
          	<i class="hamburger align-self-center"></i>
        </a>
        <h1 class="h2">List of Products</h1>
        <div class="card" style="width:100%;">
            <div class="card-body">
                <form method="post">                                      
                    <?php if($_SESSION['user'] == "admin"){  
                        echo "<a class=add href=addProd.php style=font-size:16px; background-color:green;>Add Product</a>";   ?>
                    
                    <div style="overflow: scroll">
                        <table id="tblProd" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Product Name</th>
                                    <!-- <th>Product&nbsp;Short&nbsp;Description</th> -->
                                    <th>Product Long Description</th>
                                    <th>Product Price</th>
                                    <th>Category</th>
                                    <th>SKU</th>
                                    <!-- <th>Product&nbsp;Image</th> -->
                                    <!-- <th>Image</th> -->
                                    <th style="text-align:center">Actions</th>
                                </tr> 
                            </thead>    
                                <?php $i=0;
                                $countProdRows = 0;
                                $stmnt_prod = $conn->prepare("SELECT * FROM products order by id ASC");
                                $stmnt_prod->execute();
                                
                                ?>                               
                                         <tbody>
                                         <?php
                                         while($rows = $stmnt_prod->fetch(PDO::FETCH_ASSOC)){ $i++;
                                    $countProdRows = count($rows);
                                    if($countProdRows >= 1){ ?>
                                             <tr>
                                                 <td><?php echo $i;?></td>
                                                 <td><?php echo $rows['prodName']; ?></td>
                                                 <td><?php echo $rows['prodLongDesc']; ?></td>
                                                 <td><?php echo $rows['prodPrice']; ?></td>
                                                 <td><?php echo $rows['categ']; ?></td>
                                                 <td><?php echo $rows['SKU']; ?></td> 
                                                 <!-- <td><img src="Uploads/".<?php // echo $rows['image']; ?> width=85 height=70></td> -->
                                                 <td><a class="add" href="editProd.php?id=<?php echo $rows['id']; ?>"><i class=align-middle data-feather=edit></i></a>
                                                 <a class="add" href="deleteProd.php?id=<?php echo $rows['id']; ?>"><i class=align-middle data-feather=trash></i></a>
                                                 </td>
                                             </tr>
                                         </tbody>

                                         <?php
                                        }
                                    }
                                ?>
                        </table>
                    </div>                        
                </form>
            </div>
        </div>
    </div>

        <?php } else{ 
            echo "<script>alert('User Doesnot exist');</script>";
            echo "Invalid Session, try <a href=Login.php>logging in</a> here "; } ?>
        <?php }   ?>
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

<script>
    $(document).ready(function() {
        $('#tblProd').DataTable();
    });
</script>


</body>
</html>