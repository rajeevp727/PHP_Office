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
<div class="wrapper">
<nav id="sidebar" class="sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="Dashboard.php">
                <span class="align-middle">Ecommerce Project</span>
            </a>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Pages
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="Dashboard.php">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>	

                <li class="sidebar-item">
                    <a href="#uers" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Users</span>
                    </a>
                    <ul id="uers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="createUsers.php">Add Uers</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="viewUsers.php">List Users</a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#categ" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categories</span>
                    </a>
                    <ul id="categ" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="addCateg.php">Add Categories</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="listCateg.php">List Categories</a></li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a href="#prod" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Products</span>
                    </a>
                    <ul id="prod" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="addProd.php">Add Products</a>
                        <li class="sidebar-item"><a class="sidebar-link" href="listProd.php">List Products</a>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Profile.php">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Profile</span>
                    </a>
                </li>	

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Logout.php">
                        <i class="align-middle" data-feather="key"></i> <span class="align-middle">Logout</span>
                    </a>
                </li>						
                </li>
            </ul>
        </div>
    </nav>
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
        <a class="sidebar-toggle d-flex">
          	<i class="hamburger align-self-center"></i>
        </a>
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
 
 <footer class="footer" style="position:fixed; bottom:0px; width:77%;">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a href="index.html" class="text-muted"><strong>Ecommerce Project</strong></a> &copy;
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-muted" href="#">Support</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="#">Help Center</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="#">Privacy</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="#">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </footer>
    </div>

</body>
</html>