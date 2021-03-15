<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
<!-- Validate the fields -->
<?php
      if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
    include "DB_Connect.php";
    $fName = $password = $status = "";
    $fNameErr = $passwordErr = "";
    $sessName = $user = $status = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['fName'])){ $fNameErr = "First Name is Required"; } else{ $fName = $_POST['fName']; }
        if(empty($_POST['password'])){ $passwordErr = "Password is Required"; } else{ $password = $_POST['password']; }
    
    // <!-- Retrieve data -->
    if(isset($_POST['btnLogin'])){
        if(!(empty($fName) || empty($password))){
        $stmnt = $conn->prepare("SELECT * FROM users WHERE firstName=:fname and password=:password");
        $stmnt->execute([':fname'=>$fName, ':password'=>$password]);
        $count = $stmnt->rowCount();
        $row = $stmnt->fetch(PDO::FETCH_ASSOC);
        if($count == 1 || $count >0){
        try{
        $stmntUserType= $conn->prepare("SELECT * FROM users WHERE firstName=:fName");
        $stmntUserType->execute([":fName"=>$fName]);
        while($r= $stmntUserType->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['fName'] = $r['firstName'];
            $_SESSION['userType'] = $r['userType'];
        }
        header("location: homePage.php");
        }catch(PDOEXCEPTIOn $e){ echo "Error: ".$e->getMessage(); }
        }else{echo "<script>alert('Could not fetch records, Try again');</script>";  }
        }else{ echo "<script>alert('Fields cannot be empty')</script>"; }
      }    
    if(isset($_POST['btnRegister'])){ header("location: userRegister.php"); }
}

?>
    <h1 style="text-align:center">User Login</h1>
    <form action="#" method="post">
        <input type="text" name="fName" placeholder="Enter your First Name: " autofocus><span class="error">*<?php echo $fNameErr; ?></span><br>
        <input type="password" name="password" placeholder="Enter your Password: "><span class="error">*<?php echo $passwordErr; ?></span><br>
        <input type="submit" name= "btnLogin" value="Login">
        <input type="submit" name= "btnRegister" value="Register">
    </form>
</body>
</html>