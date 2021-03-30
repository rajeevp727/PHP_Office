<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
 include "DB_Connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <!-- <link rel="stylesheet" href="Profile.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
.img-thumbnail{
    margin-top: 70px;
}
body {
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.card{
    -moz-border-radius: 2%;
    -webkit-border-radius: 2%;
    border-radius: 2%;
    box-shadow: 5px 5px 0 rgba(0,0,0,0.08);
}

.profile .profile-body {
    padding: 20px;
    background: #f7f7f7;
}

.profile .profile-bio {
    background: #fff;
    position: relative;
    padding: 15px 10px 5px 15px;
}

.profile .profile-bio a {
    left: 50%;
    bottom: 20px;
    margin: -62px;
    text-align: center;
    position: absolute;
}

.profile .profile-bio h2 {
    margin-top: 0;
    font-weight: 200;
}

h1, h2, h3, h4, h5, h6 {
    color: #585f69;
    margin-top: 5px;
    text-shadow: none;
    font-weight: normal;
    font-family: 'Open Sans', sans-serif;
}
h2 {
    font-size: 24px;
    line-height: 33px;
}

p, li, li a {
    color: #555;
}
    </style>
</head>

<body>
<?php 
if(isset($_SESSION['user'])){
$fname = $lname = $email = $userName = $pass = $confPass = "";
if(isset($_POST['editProfile'])){  
    header("location: editUserProfile.php");    
}
if(isset($_POST["btnLogout"])){  
    // session_unset();  
    // session_destroy();  
    header("location: Logout.php");  
}
if(isset($_POST["btnCategories"])){  
    header("location: homePage.php");  
}
?>
<h1><marquee direction="left"><strong>Welcome User: </strong><?php echo " ".$_SESSION['user']; ?></marquee></h1>
<form action="" method="post">
<div class="container bootstrap snippets bootdey">
  <div class="profile card">
     <div class="profile-body">
       <div class="profile-bio">
         <div class="row">
           <div class="col-md-2 text-center">
               <img class="img-thumbnail md-margin-bottom-10" src="https://bootdey.com/img/Content/user-453533-fdadfd.png">
               <input type="submit" value="Edit Profile" name="editProfile" style="background-color:#66ff99; width:100%;">
           </div>
           <div class="col-md-10">
              <span><strong>User Name:</strong><?php echo " ".$_SESSION['user']; ?></span>
              <span style="float:right">
                <input type="submit" value="Logout" name="btnLogout" style="background-color:#66ff99;">
              </span>
              <hr>
              <?php
              if(isset($_SESSION['user'])){ 
              $sql_getUsers = $conn->prepare("SELECT * from users where fName=:fname"); 
              $sql_getUsers->bindParam(":fname", $_SESSION['user']); 
              $sql_getUsers->execute(); 
              while($rows = $sql_getUsers->fetch(PDO::FETCH_ASSOC)){ 
                  $fname= $rows['fName']; 
                  $lname= $rows['lName'];
                  $email= $rows['email'];
                  $userName= $rows['userName'];
                  $pass= $rows['password'];
                  $confPass= $rows['confirmPassword']; 
              }
              }
              ?>

                <div>
                <h2>User Details::</h2>
                </div>
                <div>
                    <table border=1px style="border-collapse: collapse; width: 100%;">
                    <tr><td style="width:50%;">First Name</td><td><?php echo $fname; ?></td></tr>
                    <tr><td>Last Name</td><td><?php echo $lname; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                    <tr><td>User Name</td><td><?php echo $userName; ?></td></tr>
                    <tr><td>Password</td><td><?php echo $pass; ?></td></tr>
                    <tr><td>Confirm Password</td><td><?php echo $confPass; ?></td></tr>
                    </table>
                    <br>
                </div>
              </form>
           </div>
         </div>
       <div>
        <input type="submit" value="View Categories & Products" name="btnCategories" style="width:100%; background-color:#66ff99;">
       </div>                
     </div>
   </div>
 </div>
</div>
</form>
<?php }else{ 
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid User Session, try <a href=Login.php>logging in</a> here "; } ?>
</body>
</html>