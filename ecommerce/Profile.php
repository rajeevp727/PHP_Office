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
<form action="#" method="post">
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = $lname = $email = $userName = $pass = $confPass = "";
if(isset($_POST["btnCategories"])){ 
    header("location: homepage.php"); 
}

if(isset($_POST["btnLogout"])){
    header("location: Logout.php");
}
if(isset($_POST['editProfile'])){
    header("location: editUSerProfile.php");
}
}
?>
<h1><marquee direction="left">User Profile</marquee></h1>
<div class="container bootstrap snippets bootdey">
  <div class="profile card">
     <div class="profile-body">
       <div class="profile-bio">
         <div class="row">
           <div class="col-md-2 text-center">
               <img class="img-thumbnail md-margin-bottom-10" src="https://bootdey.com/img/Content/user-453533-fdadfd.png">
           </div>
           <div class="col-md-10">
              <span><strong>Welcome:</strong><?php echo " ".$_SESSION['user']; ?></span>
              <span style="float:right">
                <input type="submit" value="Edit Profile" name="editProfile" style="background-color:#66ff99;">
                <input type="submit" value="Logout" name="btnLogout" style=" background-color:#66ff99;">
              </span>
              <hr>
              <?php
              $sql_getUsers = $conn->prepare("SELECT * from users where fName=:fname");
              $sql_getUsers->execute([":fname"=>$_SESSION['user']]);
              while($rows = $sql_getUsers->fetch(PDO::FETCH_ASSOC)){
                  $fname= $rows['fName'];
                  $lname= $rows['lName'];
                  $email= $rows['email'];
                  $userName= $rows['userName'];
                  $pass= $rows['password'];
                  $confPass= $rows['confirmPassword'];
              }
              ?>
              <form action="" method="post">
                <div>
                <h2>User Details::</h2>
                </div>
                <div>
                    <table border=1px style="border-collapse: collapse">
                    <tr><td>First Name</td><td><?php echo $fname; ?></td></tr>
                    <tr><td>Last Name</td><td><?php echo $lname; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                    <tr><td>User Name</td><td><?php echo $userName; ?></td></tr>
                    <tr><td>Password</td><td><?php echo $pass; ?></td></tr>
                    <tr><td>Confirm Password   </td><td><?php echo $confPass; ?></td></tr>
                    </table>
                    <br>
                    <!-- First Name: <?php echo $fname; ?> <br> -->
                    <!-- Last Name: <?php echo $lname; ?> <br> -->
                    <!-- Email: <?php echo $email; ?> <br> -->
                    <!-- User Name: <?php echo $userName; ?> <br> -->
                    <!-- Password: <?php echo $pass; ?> br -->
                    <!-- confirm Password : <?php echo $confPass ; ?> -->
                </div>
              </form>
           </div>
         </div>
       <div>
        <input type="submit" value="Categories" name="btnCategories" style="width:100%; background-color:#66ff99;">
       </div>                
     </div>
   </div>
 </div>
</div>
</form>
</body>
</html>