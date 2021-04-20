<?php
require "config/config.inc.php";
$title = "Categories | E-Shopper";
include "header.php";
?>
    <section>
		<div class="container">
			<div class="row">

			<?php include "sidebar.php"; ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>		
						<?php
						if(isset($_GET['brandId'])){
							$brandId = $_GET['brandId'];
							$getThisBrand = mysqli_query($conn, "SELECT * FROM products WHERE products.brandId = $brandId");
							while($brandRows = mysqli_fetch_assoc($getThisBrand)){ ?>
								<div class="col-sm-4">			
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
										<form action="cart.php" method="post" enctype="multipart/form-data">
											<img src="images/Uploads/<?php echo $brandRows['image']; ?>" alt="product" />
											<h2>$ <?php echo $brandRows['prodPrice']; ?></h2>
											<p><a href="product-details.php?id=<?php echo $brandRows['id']; ?>"><?php echo $brandRows['prodDesc']; ?></a></p>
											<input type="submit" name="addToCart" value="Add to Cart" style="width:130px; background-color:orange">

											<input type="hidden" name="productImage" value="<?php echo $brandRows['image']; ?>">
											<input type="hidden" name="productName" value="<?php echo $brandRows['prodDesc']; ?>">
											<input type="hidden number" name="productPrice" value="<?php echo $brandRows['prodPrice']; ?>">
											<input type="hidden" name="webID" value="5180899">
											<input type="hidden" name="productQuantity" value="1">
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
                         $getProd = mysqli_query($conn, "SELECT * FROM products");
                         while($prodRow = mysqli_fetch_assoc($getProd)){
                        ?>
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									<form action="cart.php" method="post" enctype="multipart/form-data">
										<img src="images/Uploads/<?php echo $prodRow['image']; ?>" alt="product" />
										<h2>$ <?php echo $prodRow['prodPrice']; ?></h2>
										<p><a href="product-details.php?id=<?php echo $res['id']; ?>"><?php echo $prodRow['prodDesc']; ?></a></p>
										<input type="submit" name="addToCart" value="Add to Cart" style="width:130px; background-color:orange">

										<input type="hidden" name="productImage" value="<?php echo $prodRow['image']; ?>">
										<input type="hidden" name="productName" value="<?php echo $prodRow['prodDesc']; ?>">
										<input type="hidden" name="productPrice" value="<?php echo $prodRow['prodPrice']; ?>">
										<input type="hidden" name="webID" value="5180899">
										<input type="hidden" name="productQuantity" value="1">
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
						<?php }	 }	?>	

						<ul class="pagination" >
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