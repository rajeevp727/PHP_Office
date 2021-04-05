<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Document</title>
</head>
<body>
<?php
include "DB_Connect.php";
$userName = $password = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){    
    if(isset($_POST['btnSignIn'])){
        if(!empty($_POST["userName"])){ $userName = $_POST['userName']; }
        if(!empty($_POST["password"])){ $password = $_POST['password']; }
        ?>

        <script>
            $(document).ready(function(){
                $("#userName").attr("required", "true");
                $("#password").attr("required", "true");
            });
        </script>        
        
        <?php
        $Stmnt_login = $conn->prepare("SELECT * FROM users WHERE userName=:userName and password=:pass");
        $Stmnt_login->bindParam(":userName",$userName );
        $Stmnt_login->bindParam(":pass", $password);
        $Stmnt_login->execute();
        $countUsers = $Stmnt_login->rowCount();
        if($countUsers >= 1){
            while($rows = $Stmnt_login->fetch(PDO::FETCH_ASSOC)){
                $_SESSION['user'] = $userName;
            }
        header("location: Profile.php");
    } elseif($countUsers == 0){ echo "<script>alert('Could not fetch records, Try again');</script>"; }
    }

    if(isset($_POST['btnCancel'])){
        header("location: Dashboard.php");
    }
}
?>
<h1><marquee direction="right">Login Page</marquee></h1>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back, User</h1>
                        <p class="lead">	Sign in to your account to continue		</p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                </div>
                                <form method="post">
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" id="userName" name="userName" placeholder="Enter your USer Name" autofocus/>
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter your password"/>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary" name=btnSignIn>Sign in</button>
                                        <button type="submit" class="btn btn-lg btn-primary" name=btnCancel>Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </main>
 
 <script src="app.js"></script>    
 
</body>
</html>