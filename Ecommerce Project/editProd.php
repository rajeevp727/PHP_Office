<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- Used to Preview the image before Uploading -->

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

    <div class="main" style="overflow: scroll;">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
            <a class="sidebar-toggle d-flex">
          	    <i class="hamburger align-self-center"></i>
            </a>
                <?php
                    if(isset($_GET['id'])){
                        $thisID = $_GET['id'];
                    $id = $ProdName = $ProdShortDesc = $ProdLongDesc = $ProdPrice = $SKU = $image = $categ = $status = "";
                    include "DB_Connect.php";
                    $sql_prodEdit = $conn->prepare("SELECT * FROM products where id=:id");
                    $sql_prodEdit->execute([":id"=>$_GET['id']]);
                    while($rows= $sql_prodEdit->fetch(PDO::FETCH_ASSOC)){
                        // Getting Data from DataBase
                        $id = $rows['id'];
                        $getProdName = $rows['prodName'];
                        $getProdShortDesc = $rows['prodShortDesc'];
                        $getProdLongDesc = $rows['prodLongDesc'];
                        $getProdPrice = $rows['prodPrice'];
                        $getcateg = $rows['categ'];
                        $getSKU = $rows['SKU'];
                        $image = $rows['image'];
                        $getStatus = $rows['status'];
                    }

                    $DB_conn = new mysqli("localhost", "root", "", "ecommerce");
                    $sqlCateg = "SELECT categName from categories";
                    $sqlCategList = mysqli_query($DB_conn, $sqlCateg);

                    $sqlStatus = "SELECT status FROM products";
                    $statusList = mysqli_query($DB_conn, $sqlStatus);

                    if(isset($_POST['btnEditProd'])){
                        $setProdName= $_POST["prodName"];
                        $setProdShortDesc= $_POST["prodShortDesc"];
                        $setProdLongDesc= $_POST["prodLongDesc"];
                        $setProdPrice= $_POST['prodPrice'];
                        $setcateg= $_POST['categ'];
                        $setSKU= $_POST['SKU'];

                        $setImage=$_FILES['image']['name'];
                        $tmpName = $_FILES['image']['tmp_name'];

                        $setStatus= $_POST['status'];
                        try{
                            // UPLOADING IMAGE
                        if(!empty($setImage)){
                            $file = $_FILES['image']['tmp_name'];
                            move_uploaded_file($_FILES["image"]["tmp_name"], "Uploads/" . $_FILES["image"]["name"]);
                            $image_save ="Uploads/" . $_FILES["image"]["name"];                            
                            }
                        
                        $statusMsg="";
                        $tar_dir = "Uploads/";
                        $fileName = basename($_FILES['image']['name']);
                        $targetFilePath = $tar_dir. $fileName;
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if(!empty($_FILES['image']['name'])){
                            $allowedTypes = array('jpg', 'png', 'jpeg');
                            if(in_array($fileType, $allowedTypes)){
                                if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)){
                                    $sqlImage = $DB_conn->query("INSERT INTO products(image) VALUES ('$fileName')");
                                    if($sqlImage){
                                        $statusMsg = "File ".$fileName." is successfully uuploaded"; 
                                    }else{
                                        $statusMsg = "File".$fileName." Could not be inserted";
                                    }
                                }else{
                                $statusMsg = "There was an error, try again.";}
                        }else{
                            $statusMsg = "Only the file types png jpg and jpeg ae allowed.";
                            }
                        }
                        // end Upload Image
                        }catch(Exception $e){ echo $e->getMessage(); }
                                                
                            $conn = new mysqli("localhost", "root", "", "ecommerce"); 
                            $sqlUpdate = "UPDATE products SET prodName='$setProdName', prodShortDesc='$setProdShortDesc', prodLongDesc='$setProdLongDesc', prodPrice='$setProdPrice', categ='$setcateg', SKU='$setSKU', image='$image', status='$getStatus' WHERE prodName='$setProdName'";
                            $updateData = mysqli_query($conn, $sqlUpdate);
                            
                           if($updateData){
                            echo "Data Updated Successfully";
                           }
                                                  
                            
                        }
                    ?>
                <div class="row vh-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Edit your Products here</h1>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="id"></label>
                                            <input type="text" class="form-control form-control-lg" name="id" value="<?php echo $id; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                        <label for="prodName">Product Name: </label>
                                            <input class="form-control form-control-lg" type="text" name="prodName" autofocus value='<?php echo $getProdName; ?>' >
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodShortDesc">Product Short Description: </label>
                                            <input class="form-control form-control-lg" type="text" maxlength="20" name="prodShortDesc" value='<?php echo $getProdShortDesc; ?>'>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodLongDesc">Product Long Description: </label>
                                            <input class="form-control form-control-lg" type="text" name="prodLongDesc" value='<?php echo $getProdLongDesc; ?>'>
                                        </div>
                                        <div class="mb3">
                                            <label for="prodPrice">Prodcut Price: </label>
                                            <input class="form-control form-control-lg" type="number" name="prodPrice" value=<?php echo $getProdPrice; ?> />
                                        </div>
                                        <div class="mb-3">
                                        <label for="categ">Category: </label>
                                            <select class="form-control form-control-lg" name="categ">
                                            <?php while($rows = mysqli_fetch_assoc($sqlCategList)){ ?>
                                                <option value="<?php echo $rows['categName']; ?>"><?php echo $rows['categName'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="SKU">SKU: </label>
                                            <input type="text" class="form-control form-control-lg" maxlength="10" name="SKU" value=<?php echo $getSKU;?> readonly >
                                        </div>
                                        <div class="mb-3">
                                            <?php $imgSrc = "Uploads/".$image;  ?>
                                            <label for="image">Select an Image to Upload:</label>
                                            <input type="file" name="image" id="imgToUpload" class="form-control form-control-lg" onChange="displayImage(this)" >
                                            <div class="empty-text">
                                            <img id="image" name="image" src=<?php echo $imgSrc; ?> width="500" height="500" onClick="triggerClick()">
                                            </div>
                                        </div>
                                            <div class="mb-3">                                            
                                                <label for="status">Product Status</label>
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        <div class="text-center mt-3">                                        
                                            <input type="submit" class="btn btn-lg btn-primary">
                                            <a href="listprod.php" class="btn btn-lg btn-primary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </main>       
    <?php
    } else{ echo "<script>alert('ID cannot be empty');</script>"; 
        echo "Try <a href=Login.php> Logging in</a> agian"; }
    
    ?>

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
    $('#imgToUpload').on('change', function() {

var file = this.files[0];
var imagefile = file.type;
var imageTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
if (imageTypes.indexOf(imagefile) == -1) {
    //display error
    return false;
    $(this).empty();
}
else {
    var reader = new FileReader();
    reader.onload = function(e) {
        $(".empty-text").html('<img src="' + e.target.result + '"  />');
    };
    reader.readAsDataURL(this.files[0]);
}
});
</script>
<script>
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
</script>
</body>
</html>