
<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category  <a href="addCateg.php"><span class="glyphicon glyphicon-plus"></span></a></h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			<div class="panel panel-default">
            <?php 
            $getCateg = mysqli_query($conn, "SELECT * FROM categories");
			while($categRows = mysqli_fetch_array($getCateg)){ 
				$sqlCateg = mysqli_query($conn, "SELECT id, prodName FROM products WHERE products.categId = '$categRows[id]'");
				$categCount = mysqli_num_rows($sqlCateg);
			?>
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-parent="#accordian" href="shop.php?categId=<?php echo $categRows['id'];?>">
						<!-- <span class="badge pull-right"><i class="fa fa-plus"></i> </span> -->
						<span class="pull-right">(<?php echo $categCount; ?>)</span>
                        	<?php echo $categRows['categName'];?> </a>
							<a href="deleteCateg.php?id=<?php echo $categRows['id'];?>"><span class="glyphicon glyphicon-minus"></span></a></h4>
				</div>
				<?php } ?>
			</div>
		</div><!--/category-productsr-->
	
		<div class="brands_products"><!--brands_products-->
			<h2>Brands  <a href="addBrands.php"><span class="glyphicon glyphicon-plus"></span></a></h2>
			<?php 
			$brands = mysqli_query($conn, "SELECT * FROM brands");
			while($getBrands = mysqli_fetch_assoc($brands)){
				$sqlBrand = mysqli_query($conn, "SELECT id, prodName FROM products WHERE products.brandId = '$getBrands[id]'");
				$brandCount = mysqli_num_rows($sqlBrand);
				?>
				
			<div class="panel-heading">
					<h4 class="panel-title">	
					<a href="categories.php?brandId=<?php echo $getBrands['id']?>" style="color:black"> 
					<span class="pull-right">(<?php echo $brandCount; ?>)</span>
					<?php echo $getBrands['brandName'];?> </a>
					<a href="deleteBrand.php?id=<?php echo $getBrands['id']; ?>"><span class="glyphicon glyphicon-minus"></span></a></h4>
			</div>
			<?php } ?>
		</div><!--/brands_products-->
		
		
		<div class="price-range"><!--price-range-->
			<h2>Price Range</h2>
			<div class="well text-center">
				 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="10" data-slider-value="[250,650]" id="sl2" ><br />
				 <b class="pull-left">$ 0</b> <b class="pull-right">$ 1000</b>
			</div>
		</div><!--/price-range-->
		
		<div class="shipping text-center"><!--shipping-->
			<img src="images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->
		
	</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/main.js"></script>

</body>
</html>