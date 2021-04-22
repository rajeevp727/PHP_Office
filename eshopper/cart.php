<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
// session_unset();
require "config/config.inc.php";
$title = "Cart | E-Shopper";
include "header.php";


// if($_SESSION['prodId'] == ''){
	// $getSql = mysqli_query($conn, "SELECT * FROM products where id='$_SESSION[prodId]'");
	// while($prodSQL = mysqli_fetch_assoc($getSql)){
		// $pid = $prodSQL['id'];
		// $pName = $prodSQL['prodName'];
		// $pDesc = $prodSQL['prodDesc'];
		// $pPrice = $prodSQL['prodPrice'];
	// }
	// $_SESSION['prodId'][0] = array($pid, $pName, $pDesc, $pPrice);
	// print_r($_SESSION['prodId']); exit;
	// $_SESSION['prodId'][0] = array();
// }
// else
 if($_SESSION['prodId'] != ''){
	$sql = mysqli_query($conn, "SELECT * FROM products where id='$_SESSION[prodId]'");
	$count = mysqli_num_rows($sql);
	$_SESSION['itemsCount'] = $count;
	$j= 0;
	while($cartRows = mysqli_fetch_assoc($sql)){
		$_SESSION['cart'][$j] = $cartRows;
		echo "<pre>";print_r($_SESSION['cart']);
	 if(isset($_POST['delete'])){
		if($_POST['id'] != ''){
			$id = $_POST['id'];
			if(!empty($_SESSION['prodId'])){
			// foreach($_SESSION['prodId'] as $k=>$v){
				if($cartRows['id'] == $id){
					unset($_SESSION['prodId']);
					echo "<script>alert('Item Removed'); window.location.href='cart.php';</script>";	}
			}
		}
	}

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
							<td class="quantity">Quantity</td>
							<td class="price">Price</td>
							<td>Actions:</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$total=0;
						$j=1;
							$total+=(int)$cartRows['prodPrice'];
							echo "<tr>".
							"<td class='text-center'>$j</td>".
							"<td><img src=images/Uploads/$cartRows[image]></td>".
							"<td>$cartRows[prodName]</td>".
							"<td>".
							"<button onclick=this.parentNode.querySelector('input[type=number]').stepDown() class='minus'>-</button>".
							"<input type='number' min=0 value='1' style='width:30px'>".
							"<button onclick=this.parentNode.querySelector('input[type=number]').stepUp() class='plus'>+</button>".							
							"</td>".
							"<td>$cartRows[prodPrice]</td>".
							"<td>".
							"<form action='cart.php' method='post'>".
								"<button name= 'delete' class='btn btn-sm btn-danger'>Delete</button>".
								"<input type='hidden' name='id' value='$cartRows[id]'>".
							"</form>".
							"</td>". 
							"</tr>";
							$j++;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<?php if($total != 0){ ?>
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
							<li>Cart Sub Total <span>$<?php echo $total; ?></span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
					<?php } }
					$_SESSION['cart'] += $cartRows;
					// } $count = mysqli_num_rows($cartRows); 
					// echo $count;
				}else{
					echo "<span class='text-center'><h1>Your Shopping cart is empty, start shopping <a href ='index.php'>here</a></h1></span>"; 	}	?> 	
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<?php include "footer.php";?>
</body>
</html>