<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logout Page</title>
    <style>
    body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
    </style>
</head>
<body>
<?php if(isset($_SESSION['user'])) { ?>
    <h1><marquee direction="left">Logout Page</marquee></h1>
    <div style="text-align:center;">
    <p style="font-size:20px">User "<?php 
    if(isset($_SESSION['user'])){  echo $_SESSION['user']; }
    else{ echo "Invalid"; }
    ?>" Session ended</p>
    <h2>Click <b><a href="Login.php">here</a></b> to login again</h2p>
    <?php
    session_destroy();
    session_unset();
    ?>
    </div>
    <?php
        }else{
            echo "<script>alert('User Doesnot exist');</script>";
            echo "Invalid Session, try <a href=Login.php>logging in</a> here "; 
        } 
    ?>
</body>
</html>