<?php
session_start();
$title = "User Account";
include "header.php";
?>
<body>
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
            <h2>User account - <?php if(!empty($_SESSION['user'])){
                echo $_SESSION['user']; ?></h2>
                        <?php }else{   echo "Invalid USer, try <a href='login.php'>logging</a> in again";  } ?>
                        <div class="col-sm-4 col-sm-offset-1">
                        
                        <div class="login-form"><!--login form-->
                        User Name - <?php echo $_SESSION['user']; ?>
                        
            </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>