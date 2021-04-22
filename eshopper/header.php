<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <link href="css/bootstrap4.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>	
<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6 ">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href=""><i class="fa fa-phone"></i> +91 7032075893</a></li>
							<li><a href=""><i class="fa fa-envelope"></i> mrrajeev18@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="https://www.dribbble.com"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="https://www.googleplus.com"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->
	
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-md-4 clearfix">
					<div class="logo pull-left">
						<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
					</div>
					<div class="btn-group pull-right clearfix">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								USA
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canada</a></li>
								<li><a href="">UK</a></li>
							</ul>
						</div>
						
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								DOLLAR
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canadian Dollar</a></li>
								<li><a href="">Pound</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 clearfix">
					<div class="shop-menu clearfix pull-right">
						<ul class="nav navbar-nav">
							<li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
							<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
							<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart<span class="badge">
								<?php
								if(isset($_SESSION['user'])){ 
									echo "<script>alert('Welcome user - $_SESSION[user]');</script>";
									if(isset($_SESSION['itemsCount'])){
								$count = $_SESSION['itemsCount'];
								echo $count;
								} else { echo 0; }
							}else{ echo ""; }
								?>
							</span></a></li>
							<?php if(empty($_SESSION['user'])){?>
							<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
							<?php } else {?>
							<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->
	
	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="index.php">Home</a></li>
							<li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="categories.php" class="active">Products</a></li>
									<li><a href="product-details.php">Product Details</a></li> 
									<li><a href="checkout.php">Checkout</a></li> 
									<li><a href="cart.php">Cart</a></li> 
									<?php if(empty($_SESSION['user'])){?>
									<li><a href="login.php">Login</a></li>
									<?php } else{?>
									<li><a href="logout.php">Logout</a></li>
									<?php }?>
                                </ul>
                            </li> 
							<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.php">Blog List</a></li>
									<li><a href="blog-single.php">Blog Single</a></li>
                                </ul>
                            </li> 
							<li><a href="404.php">404</a></li>
							<li><a href="contact-us.php">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<input type="text" placeholder="Search"/>
					</div>
				</div>
			</div>
			</div>
		</div>
</header>


	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>

	
</body>
</html>