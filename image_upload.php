<!DOCTYPE html>
<html lang="en">
<head>
    <title>image Upload</title>
</head>
<body>
<?php 
if(isset($_POST['btnSubmit'])){
    if(isset($_POST['image'])){ echo 0;
        $statusMsg=""; echo 1;
            $tar_dir = "Uploads/"; echo 2;
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
            }
        } else{ echo "<script>alert('Please select a file to Upload');</script>"; }
    }
?>
<form action="" method="post" enctype="multipart/form-data"></form>
    <label>Product Name</label>
    <input type="text" name="prodName">
        <br>
    <label>Product Description</label>
    <input type="text" name="prodDesc">
        <br>
    <label>Product Price</label>
    <input type="number" name="prodPrice">
        <br>
    <label>product Image</label>
    <input type="file" name="image">
        <br>
    <input type="submit" name="btnSubmit" value="Upload Data">
</body>
</html>