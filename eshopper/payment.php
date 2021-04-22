<?php
$title = "Payment | E-Shopper";
include "header.php";

if(isset($_POST['confirmPayment'])){
    $userName=$_POST['username'];
    $cardNumber = $_POST['cardNumber'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $cvv = $_POST['cardCVV'];
    echo "<script>window.location.href='***********************'</script>";
}
?>
	<!-- <link href="/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> -->


<body>
<div class="row justify-content-center">
<article class="card row justify-content-center" style="font-size:18px;">
<div class="card-body col-sm-12">

<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
		<i class="fa fa-credit-card" aria-hidden="false"></i> Credit Card</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
        <i class="fa fa-paypal" aria-hidden="false"></i>Paypal</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
		<i class="fa fa-University" aria-hidden="false"></i>  Bank Transfer</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade show active" id="nav-tab-card">
	<p class="alert alert-success">Some text success or error</p>
	<form role="form">
	<div class="form-group">
		<label for="username">Full name (on the card)</label>
		<input type="text" class="form-control" name="username" placeholder="Name as on Card" required style="font-size:18px;">
	</div> <!-- form-group.// -->

	<div class="form-group">
		<label for="cardNumber">Card number</label>
		<div class="input-group">
			<input type="number" class="form-control" name="cardNumber" placeholder="Card Number" style="font-size:18px;">
			<div class="input-group-append">
				<!-- <span class="input-group-text text-muted"> -->
					<!-- <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>    -->
					<!-- <i class="fab fa-cc-mastercard"></i>  -->
				<!-- </span> -->
			</div>
		</div>
	</div> <!-- form-group.// -->

	<div class="row">
	    <div class="col-sm-8">
	        <div class="form-group">
	            <label><span class="hidden-xs">Expiration</span> </label>
	        	<div class="input-group">
	        		<!-- <input type="number" class="form-control" placeholder="MM" name="month" style="font-size:18px;"> -->
                    <select name="month" style="width:185px;">
                        <option value="month">Month</option>
                        <option value="Jan">January</option>
                        <option value="Feb">February</option>
                        <option value="Mar">March</option>
                        <option value="Apr">April</option>
                        <option value="May">May</option>
                        <option value="Jun">June</option>
                        <option value="Jul">July</option>
                        <option value="Aug">August</option>
                        <option value="Sept">Sepetember</option>
                        <option value="Oct">October</option>
                        <option value="Nov">November</option>
                        <option value="Dec">December</option>
                    </select>
                    &nbsp;
                    <select name="year" style="width:181px;">
                        <option value="year">Year</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
	        	</div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" name="cardCVV" style="font-size:18px;" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
	            <input type="number" class="form-control" required style="font-size:18px;">
	        </div> <!-- form-group.// -->
	    </div>
	</div> <!-- row.// -->
	<button class="subscribe btn btn-primary btn-block" type="button" name="confirmPayment" style="font-size:18px; background-color:orange;"> Confirm  </button>
	</form>
</div> <!-- tab-pane.// -->
</div> <!-- card-body.// -->
</article> <!-- card.// -->
</div>

<?php include "footer.php";   ?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>