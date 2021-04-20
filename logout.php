<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logout User</title>
</head>
<body>
<?php
    session_unset();
    session_destroy();
    header("location:index.php");
?>    
</body>
</html>