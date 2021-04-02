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

    <link rel="stylesheet" href="app.css">
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<!DOCTYPE html>
<body>
<?php
if(isset($_GET['id'])){

$id = $ProdDesc = $ProdName = $ProdPrice = "";
include "DB_Connect.php";
$sql_prodEdit = $conn->prepare("SELECT * FROM products where id=:id");
$sql_prodEdit->execute([":id"=>$_GET['id']]);
while($rows= $sql_prodEdit->fetch(PDO::FETCH_ASSOC)){
    $id= $rows['id'];
    $prodName = $rows['prodName'];
    $prodDesc = $rows['prodDesc'];
    $prodPrice = $rows['prodPrice'];
}
if(isset($_POST['btnEditProd'])){ echo 0;
if(isset($_POST['id'])){ echo 1;
    $stmnt_ProdUpdate = $conn->prepare("UPDATE products SET prodName=:pName, prodDesc=:pDesc, prodPrice=:pPrice WHERE id=:id");
    $stmnt_ProdUpdate->bindParam(":id", $_POST['id']);
    $stmnt_ProdUpdate->bindParam(":pName", $_POST['prodName']);
    $stmnt_ProdUpdate->bindParam(":pDesc", $_POST['prodDesc']);
    $stmnt_ProdUpdate->bindParam(":pPrice", $_POST['prodPrice']);
    print_r($_POST);
    $stmnt_ProdUpdate->execute();
    header("location: listProd.php");
    } 
}else{ echo "<script>alert(Fields cannot be empty);</script>"; }

if(isset($_POST['btnCancel'])){     header("location: listProd.php");      }
?>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Edit your Products here</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                </div>
                                <form method="post">
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" name="id" readonly value=<?php echo $id; ?> >
                                    </div>    
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" name="prodName" autofocus value=<?php echo $prodName; ?> >
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" name="prodDesc"value=<?php echo $prodDesc; ?> >
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="number" name="prodPrice"value=<?php echo $prodPrice; ?> >
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary" name=btnEditProd>Update this Product</button>
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
<?php
} else{ echo "<script>alert('ID cannot be empty');</script>"; 
    echo "Try <a href=Login.php> Logging in</a> agian"; }
?>
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