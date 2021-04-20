<?php
session_start();
// session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['addToCart'])){
		if(isset($_SESSION['cart'])){
			$items = array_column($_SESSION['cart'], 'productName');
			if(in_array($_POST['productName'], $items)){
				echo "<script>alert('Item already exists');</script>";
			}
			else{
				$count = count($_SESSION['cart']); 
				$_SESSION['cart'][$count]= array('productImage'=>$_POST['productImage'], 'productName'=>$_POST['productName'], 'WebID'=>$_POST['webID'], 'prodPrice'=>$_POST['productPrice'], 	'prodQuantity'=>$_POST['productQuantity']);	
				echo "<script>alert('Item added to cart'); window.locationhref='product-details.php'</script>";
			}
			// print_r($_SESSION['cart']);
		}else{
			$_SESSION['cart']['0'] = array('productImage'=>$_POST['productImage'], 'productName'=>$_POST['productName'], 'WebID'=>$_POST['webID'], 'prodPrice'=>$_POST['productPrice'], 'prodQuantity'=>$_POST['productQuantity']);
			// print_r($_SESSION['cart']);
		}
	 }
	 if(isset($_POST['delete'])){ echo 1;
		foreach($_SESSION['cart'] as $k=>$v){
			if($v['productName'] == $_POST['productName']){
				unset($_SESSION['cart'][$k]);
				$_SESSION['cart'] = array_values($_SESSION['cart']);
				echo "<script>alert('Item Removed'); window.loation.href='mycart.php'</script>";
			}
		}
	}
}
?>
<?php
require "config/config.inc.php";
$title = "Cart | E-Shopper";
include "header.php";
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
						
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td>S. No</td>
							<td class="item">Item</td>
							<td class="description">Description</td>
							<td class="webID">Web ID</td>
							<td class="quantity">Quantity</td>
							<td class="price">Price</td>
							<td>Actions:</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$total=0;
						$i=1;
						foreach($_SESSION['cart'] as $key=>$value){
							$total+=(int)$value['prodPrice'];
							echo "<tr>
							<td>$i</td>
							<td> <img src='images/Uploads/echo $value[productImage];' alt='product Image' /> </td>
							<td>$value[productName]</td><td>$value[WebID]</td>
							<td>
							<button onclick=this.parentNode.querySelector('input[type=number]').stepDown() class='minus'>-</button>	
							<input type='number' min=0 value='$value[prodQuantity]' style='width:30px'>
							<button onclick=this.parentNode.querySelector('input[type=number]').stepUp() class='plus'>+</button>							
							</td>
							<td>$value[prodPrice]</td>
								<td>
							 <form action='cart.php' method='post'>
								<button name= 'delete' class='btn btn-sm btn-danger'>Delete</button>
								<input type='hidden' name='productName' value='$value[productName]'>
							 </form>
							</td> 
							</tr>";
							$i++;
						} 
						?>
						<tr>
							<td></td> <td></td> <td>	<?php if($total != 0){ ?>
	<h3>The total amount is:</h3></td> <td></td> <td>
						
						
						</td>
						<td> 
							<?php echo "<h3>".$total."</h3>";
							}else{	echo "<h1>Your Shopping cart is empty, start shopping <a href ='index.php'>here</a></h1>"; 	}
							
							?> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
									<option>Hyderabad</option>
									<option>Delhi</option>
									<option>Mumbai</option>
									<option>Banglore</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$56</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<?php include "footer.php";?>
</body>
</html>