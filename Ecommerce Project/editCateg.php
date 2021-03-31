<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Categories</title>

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<!DOCTYPE html>
<body>
<?php
$conn= mysqli_connect("localhost", 'root', '', 'ecommerce');
$id = $_GET['id'];

$getCategory = mysqli_query($conn, "select * from categories where id = $id");
$fetchCategory = mysqli_fetch_assoc($getCategory);

if(isset($_POST['btnEditCateg'])){
    
    $categoryname =  $_POST['categName'];
    $categorydescription = $_POST['categDesc'];
    $categoryId = $_POST['category_id'];

    //echo  "UPDATE categories SET categName='$categoryname', categDesc='$categorydescription', id=$categoryId";
    //exit;

    $upate = mysqli_query($conn, "UPDATE categories SET categName='$categoryname', categDesc='$categorydescription' WHERE id=$categoryId"); 

    if($upate){
        header("location: listCateg.php");
    }


}

?>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Add Categories here</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p><span style="color:red">*</span> Only admin can Add NEW Categories</p>
                            <div class="m-sm-4">
                                <div class="text-center">
                                </div>
                                <form method="post">
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" name="categName" autofocus value="<?php echo $fetchCategory['categName']; ?>" >
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" name="categDesc" value="<?php echo $fetchCategory['categDesc']; ?>" >
                                    </div>
                                    <input type="hidden" name="category_id" value="<?php echo $fetchCategory['id'];?>" />
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary" name=btnEditCateg>Save</button>
                                        
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
<script src="app.js"></script>    

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

<script src="app.js"></script>

</body>
</html>