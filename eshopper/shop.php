<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require "config/config.inc.php";
$title = "Shop | E-Shopper";
include "header.php";

if(isset($_POST['addToCart'])){
	$_SESSION['prodId'] = $_POST['prodId'];
	echo "<script>window.location.href='cart.php';</script>";
}
?>													
	<section>
		<div class="container">
			<div class="row">
		
			<?php include "sidebar.php"; ?>

			<div class="col-sm-9 padding-right">
			<div class="features_items"><!--features_items-->
				<h2 class="title text-center">Featured items</h2>
		    	<?php
				if(isset($_GET['categId'])){
					$categId = $_GET['categId'];
						$sql = mysqli_query($conn, "SELECT DISTINCT p.id, p.categId, p.prodName, p.prodDesc, p.prodPrice, p.image from products as p INNER JOIN categories as c WHERE p.categId=$categId");
					// Note: * is not working here for selecting all fields
				while($res = mysqli_fetch_assoc($sql)){ ?>
					<div class="col-sm-4">			
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<form action="" method="post" enctype="multipart/form-data">
										<img src="images/Uploads/<?php echo $res['image']; ?>" alt="product" />
										<h2>$ <?php echo $res['prodPrice']; ?></h2>
										<p><a href="product-details.php?id=<?php echo $res['id']; ?>"><?php echo $res['prodDesc']; ?></a></p>
										<input type="hidden" name="prodId" value="<?php echo $res['id']; ?>">
										<input type="submit" name="addToCart" value="Add to Cart" style="width:130px; background-color:orange">
								</div>
									</form>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
				<?php } 
				} else{
					// echo "<script>alert('Please select a category');</script>";
					$sqlAllProds = mysqli_query($conn, "SELECT * FROM products");
					while($getProds = mysqli_fetch_assoc($sqlAllProds)){ ?>
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									<form action="" method="post" enctype="multipart/form-data">
										<img src="images/Uploads/<?php echo $getProds['image']; ?>" alt="product" />
										<h2>$ <?php echo $getProds['prodPrice']; ?></h2>
										<p><a href="product-details.php?id=<?php echo $getProds['id']; ?>"><?php echo $getProds['prodDesc']; ?></a></p>
										<input type="hidden" name="prodId" value="<?php echo $getProds['id']; ?>">
										<input type="submit" name="addToCart" value="Add to Cart" style="width:130px; background-color:orange">
									</div>
									</form>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
			<?php }	
			}	?>
	</div>
	<ul class="pagination">
		<li class="active"><a href="">1</a></li>
		<li><a href="">2</a></li>
		<li><a href="">3</a></li>
		<li><a href="">&raquo;</a></li>
	</ul>
	</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
<?php include "footer.php"; ?>

</body>
</html>