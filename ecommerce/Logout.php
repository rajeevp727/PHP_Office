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
    <h1><marquee direction="left">Logout Page</marquee></h1>
    <div style="text-align:center;">
    <p style="font-size:20px">User Session <?php echo $_SESSION['user']; ?> ended</p>
    <h2>Click <b><a href="Login.php">here</a></b> to login again</h2p>
    <?php
    session_destroy();
    session_unset();
    ?>
    
    
    </div>
</body>
</html>