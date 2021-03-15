<?php
  if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Registration</title>
    <style>
      .error { color: red; }
    </style>
</head>
<body>
<?php include "DB_Connect.php";
  $fName = $password = $statusType = $userType = "";
  $fNameErr = $passwordErr = $statusTypeErr = $userTypeErr = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST['fname'])){ $fNameErr = "First name is required"; }else{ $fName = trim($_POST['fname']); }
  if(empty($_POST['password'])){ $passwordErr = "Password is required"; }else{ $password = trim($_POST['password']); }
  if(empty($_POST['statusType'])){ $statusTypeErr = "Status type is required"; }else{ $statusType = trim($_POST['statusType']); }
  if(empty($_POST['userType'])){ echo "<script>alert(User type is required)</script>"; }else{ $userType = trim($_POST['userType']); }

  // <!-- Insert data into database -->
  if(isset($_POST['btnRegister'])){
  if(!(empty($_POST['fname']) || empty($_POST['password']) || empty($_POST['statusType']))){
  try{
      if($conn == true){ echo "<script>alert('Connected to Database Successfully')</script>"; }
      $dup = $conn->prepare("select * from users where firstName=:fname");
      $dup->execute([":fname"=>$fName]);
      $res = $dup->fetchAll();
      $count= count($res);
      if($count>=1){ echo "<script>alert('User already exists, try again with DIFFERENT First Name');</script>";  }
      elseif($count == 0){ 
          echo "<script>alert('Creating new User:'.$fName)</script>";
      $stmnt = $conn->prepare("INSERT INTO users(firstName, password, userStatus, userType) values(:firstName, :password, :status, :user )");
      $stmnt->execute([":firstName"=> $fName, ":password"=>$password, ":status"=> $statusType, ":user"=>$userType]);
      echo "<script>alert('New Records successfully inserted into table')</script>";

      header("location: Login.php");
      }
  }catch(PDOException $e){ echo "Error: ".$e->getMessage(); }
}else{ echo "<script>alert('Fileds cannot be empty')</script>"; }
}
  }

?>

<!-- Display Form -->
<h1 style="text-align:center">User Registration</h1>
<form method="post">
    <input type="text" name="fname" size = 19 placeholder="Enter your First Name: " autofocus><span class="error">*<?php echo $fNameErr; ?></span><br>
    <input type="password" name="password" size = 19 placeholder="Enter your password: "><span class="error">*<?php echo $passwordErr;?></span><br>
    <select name="statusType">
        <option value="select"><-- select Status type --></option>
        <option value="Active" selected>Active</option>
        <option value="Inactive">Inactive</option>
    </select><span class="error">*<?php echo $statusTypeErr; ?></span><br>

    <select name="userType">
        <option value="Developer"><---Select user Type ---></option>
        <option value="Developer" selected>Developer</option>
        <option value="Tester">Tester</option>
        <option value="Deployment">Deployment</option>
        <option value="Manager">Manager</option>
    </select>
    <span class="error">*<?php echo $userTypeErr; ?></span><br>
    <input type="submit" value="Register" name="btnRegister">
    
</form>    
</body>
</html>