<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    require "config/config.inc.php";
    if(isset($_POST['Submit'])){
        $prodName = $_POST['prodName'];
        $prodDesc = $_POST['prodDesc'];
        $prodLongDesc = $_POST['prodLongDesc'];
        $prodPrice = $_POST['prodPrice'];
        // $image = $_FILES['image'];
        try{
            $statusMsg=""; echo 1;
            $tar_dir = "images/Uploads/"; echo 2;
            $fileName = basename($_FILES['image']['name']); echo 3;
            $targetFilePath = $tar_dir. $fileName; echo 4;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); echo 5;
            if(!empty($_FILES['image']['name'])){ echo 6;
                $allowedTypes = array('jpg', 'png', 'jpeg'); echo 7;
                if(in_array($fileType, $allowedTypes)){ echo 8;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)){ echo 9;
                        $sqlImage = $conn->query("INSERT INTO products(image) VALUES ('$fileName')"); echo 10;
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

        $sqlInsert = "INSERT INTO products(prodName, prodDesc, prodLongDesc, prodPrice, image) VALUES('$prodName', '$prodDesc', '$prodLongDesc', '$prodPrice', '$fileName')";
        $sqlBlank = "DELETE FROM products where prodName = ''";
        $resInsert = mysqli_query($conn, $sqlInsert);
        if($resInsert){ 
            exit;
            header("location: categories.php");
        } else{ echo "<a href=addProd.php>try agin</a>"; }
        $resDel = mysqli_query($conn, $sqlBlank);
        if($resDel){
            exit;
            header("location: categories.php");
        } else{ echo "<a href=addProd.php>try agin</a>"; }
    } else{ echo "<script>alert('Please select a file to Upload');</script>"; }
}catch(Exception $e){ echo $e; }
    }
    
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="text" name="prodName" placeholder="Enter Product Name" required> <br>
        <input type="text" name="prodDesc" placeholder="Enter Product Description" required> <br>
        <input type="text" name="prodLongDesc" placeholder="Enter Product LOng Description" required> <br>
        <input type="number" name="prodPrice" placeholder="Enter product Price" required> <br>
        <input type="file" name="image"> <br>
        <button name="Submit">Submit</button>
    </form>
</body>
</html>