<?php
require "config/config.inc.php";
$title = "Shop | E-Shopper";
include "header.php";
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
							<form action="cart.php" method="post" enctype="multipart/form-data">
								<img src="images/Uploads/<?php echo $res['image']; ?>" alt="product" />
								<h2>$ <?php echo $res['prodPrice']; ?></h2>
								<p><a href="product-details.php?id=<?php echo $res['id']; ?>"><?php echo $res['prodDesc']; ?></a></p>
								<input type="submit" name="addToCart" value="Add to Cart" style="width:130px; background-color:orange">

								<input type="hidden" name="productImage" value="<?php echo $res['image']; ?>">
								<input type="hidden" name="productName" value="<?php echo $res['prodDesc']; ?>">
								<input type="hidden" name="productPrice" value="<?php echo $res['prodPrice']; ?>">
								<input type="hidden" name="webID" value="5180899">
								<input type="hidden" name="productQuantity" value="1">

								<!-- <input type="submit" class="btn btn-default cart" value="Add to Cart" name="addToCart"> -->
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
	}else{
		echo "<script>alert('Please select a category');</script>";
	}
	
	?>
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