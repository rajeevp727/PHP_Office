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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#prodShortDesc'
        });
        tinymce.init({
            selector: '#prodLongDesc'
        });
    </script>

    <script>
    $(document).ready(function(){
        $cahrs = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $cahrLen = 10;
        $genSKU = "";
        $genSKU = $cahrs[uni];
    });
    </script>
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
    <div class="main">
    <?php
        $prodName = $prodShortDesc = $prodLongDesc = $prodPrice= $categ= $SKU = $image = $status= "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['prodName'])){
            
        }

        $DB_conn = new mysqli("localhost", "root", "", "ecommerce");
        if($_SERVER["REQUEST_METHOD"] =="POST"){
        if(!empty($_POST['prodName'])){
            $prodName = $_POST['prodName'];
            $prodShortDesc = $_POST['prodShortDesc'];
            $prodLongDesc = $_POST['prodLongDesc'];
            $prodPrice = $_POST['prodPrice'];
            $categ = $_POST['categ'];
            $SKU = $_POST['SKU'];
            $image = $_FILES['image'];
            $status = $_POST['status'];
        }

        if(isset($_POST['btnAddProd'])){
             try{ echo 0;                
            // UPLOADING IMAGE

            $statusMsg=""; echo 1;
            $tar_dir = "Uploads/"; echo 2;
            $fileName = basename($_FILES['image']['name']); echo 3;
            $targetFilePath = $tar_dir. $fileName; echo 4;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); echo 5;
            if(!empty($_FILES['image']['name'])){ echo 6;
                $allowedTypes = array('jpg', 'png', 'jpeg'); echo 7;
                if(in_array($fileType, $allowedTypes)){ echo 8;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)){ echo 9;
                        $sqlImage = $DB_conn->query("INSERT INTO products(image) VALUES ('$fileName')"); echo 10;
                        if($sqlImage){ echo 11;
                            $statusMsg = "File ".$fileName." is successfully uuploaded"; 
                        }else{ echo 12;
                            $statusMsg = "File".$fileName." Could not be inserted"; echo 13;
                        }
                    }else{ echo 14;
                    $statusMsg = "There was an error, try again.";}
            }else{ echo 15;
                $statusMsg = "Only the file types png jpg and jpeg ae allowed.";
            }
            // end Uploading Image

            $sql_Prod_add = "INSERT INTO products(prodName, prodShortDesc, prodLongDesc, prodPrice, categ, SKU, image, status) VALUES('$prodName', '$prodShortDesc', '$prodLongDesc', '$prodPrice', '$categ', '$SKU', '$fileName', '$status')";
            $sqldeleteBlanks = "DELETE from products where prodName=''";
            $deleteData = mysqli_query($DB_conn, $sqldeleteBlanks);
            $insertData = mysqli_query($DB_conn, $sql_Prod_add);
                        
            
            if($insertData){
                header("location: listProd.php");
            }
            if($deleteData){
                echo "<script>alert(Deleted blank rows);</script>";
            }
            else{ echo "<script>alert(try again);</script>"; }

        } else{ echo "<script>alert('Please select a file to Upload');</script>"; }
    //  catch(PDOException $e){ echo "error".$e->getMessage(); }
     } catch(PDOException $e){ echo "error".$e->getMessage(); }
     if(isset($_POST['btnCancel'])){
         header("location: listProd.php");
        }
     }     
//   }
  if(isset($_POST['btnCancel'])){
    header("location: listProd.php");
       }
}
        }
?>

    <?php if($_SESSION['user'] == "admin"){?>
        <div class="container d-flex flex-column">
        <a class="sidebar-toggle d-flex">
          	<i class="hamburger align-self-center"></i>
        </a>
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100 w-100">
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
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="prodName">Name your Product:</label>
                                            <input class="form-control form-control-lg" type="text" name="prodName"  autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodShortDesc">Describe your Product in a few lines:</label>
                                            <textarea class="form-control form-control-lg" name="prodShortDesc" maxlength="30" rows="5" ></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodLongDesc">Describe your Product in detail:</label>
                                            <textarea class="form-control form-control-lg" name="prodLongDesc" rows="5" ></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodPrice">Product Price:</label>
                                            <input class="form-control form-control-lg" type="number" name="prodPrice" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="categ">Category:</label>
                                            <select name="categ" style="width:100%">
                                                <option value="Uncategorized">Uncategorized</option>
                                                <option value="Accessories">Accessories</option>
                                                <option value="Gadgets">Gadgets</option>
                                                <option value="Books">Books</option>
                                                <option value="Sports">Sports</option>
                                                <option value="Furniture">Furniture</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                        <?php 
                                        ?>
                                            <!-- Here we are limiting the length of SKU to 10 chars using the substr() method
                                            and using md5() method to generate a qnique alphanumeric string based on the Product's name-->
                                            <label for="SKU">SKU</label>
                                            <input type="text" class="form-control form-control-lg" maxlength="10" name="SKU" value=<?php echo substr(md5($prodName), 0,10); ?> readonly > 
                                        </div>
                                        <div class="mb-3">
                                            <label for="image">Select an Image to Upload:</label>
                                            <input type="file" class="form-control form-control-lg" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Product Status</label>
                                            <select name="status" style="width:100%">
                                                <option value="Active">Active</option>
                                                <option value="inActive">inActive</option>
                                            </select>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary" name="btnAddProd">Add Product</button>
                                            <button type="submit" class="btn btn-lg btn-primary" name="btnCancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <?php } else{
            echo "<script>alert(Only admin can add NEW Products);</script>";
            echo "<span style=color:red;font-size:20px;>*</span>Only ADMIN can add NEW Products";
        }?>
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