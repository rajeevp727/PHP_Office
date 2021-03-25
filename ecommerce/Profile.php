<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <!-- <link rel="stylesheet" href="Profile.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
body {
	color: #fff;
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
if(isset($_POST["btnCategories"])){ 
    header("location: homepage.php"); 
}

if(isset($_POST["btnLogout"])){
    header("location: Logout.php");
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
              <span><strong>Position:</strong> Web Designer</span>
              <span style="float:right">
                <input type="submit" value="Logout" name="btnLogout" style="width:100%; background-color:#66ff99;">
              </span>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget massa nec turpis congue 
                bibendum. Integer nulla felis, porta suscipit nulla et, dignissim commodo nunc. Morbi a semper nulla.</p>
                <p>Proin mauris odio, pharetra quis ligula non, vulputate vehicula quam. Nunc in libero vitae nunc 
                ultricies tincidunt ut sed leo. Sed luctus dui ut congue consequat. Cras consequat nisl ante, nec malesuada
                velit pellentesque ac. Pellentesque nec arcu in ipsum iaculis convallis.</p>
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