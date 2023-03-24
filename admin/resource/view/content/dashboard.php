<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/DashboardController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$dashboard = new DashboardController;
$eloquent = new Eloquent;


## ===*=== [F]ETCH SUMMARY DATA ===*=== ##

#== TOTAL SALE STATUS
$saleResult = $dashboard->sumResult('orders', 'grand_total');
$totalSale = ceil($saleResult[0]['SUM(grand_total)']);	


#== THIS MONTH SALE STATUS
$monthResult = $dashboard->sumByDate('orders', 'grand_total', 'order_date');
$monthSale = ceil($monthResult[0]['SUM(grand_total)']);


#== NEWLY ADDED PRODUCT STATUS
$newResult = $dashboard->dateData('products', 'created_at');
$newProduct = count($newResult);	


#== TOTAL TAX STATUS
$taxResult = $dashboard->sumResult('orders', 'tax');
$totalTax = ceil($taxResult[0]['SUM(tax)']);	


#== NEW ORDER STATUS
$orderResult = $dashboard->getData('orders', 'order_item_status', 'Pending');
$totalOrder = count($orderResult);


#== PRODUCT STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "products";
$productResult = $eloquent->selectData($columnName, $tableName);
$totalProduct = count($productResult);	


#== SUBSCRIBER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "newsletters";
$subscriberResult = $eloquent->selectData($columnName, $tableName);
$totalSubscriber = count($subscriberResult);	


#== CUSTOMER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "customers";
$customerResult = $eloquent->selectData($columnName, $tableName);
$totalCustomer = count($customerResult);

## ===*=== [F]ETCH SUMMARY DATA ===*=== ##
?>

<!--=*= DASHBOARD SECTION START =*=-->
<div class="wrapper">	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-rupee"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Sale </span>
							<h4 class="counter"> <?= $totalSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-tags"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Sales This Month </span>
							<h4 class="counter"> <?= $monthSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-gavel"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Order </span>
							<h4 class="counter"> <?= $totalOrder ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Tax </span>
							<h4 class="counter"> <?= $totalTax ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-dot-circle-o"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Products Added </span>
							<h4 class="counter"> <?= $newProduct ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-anchor"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Products </span>
							<h4 class="counter"> <?= $totalProduct ?></h4>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-chain"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Newsletter Subscriber </span>
							<h4 class="counter"> <?= $totalSubscriber ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-user"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Register Customer </span>
							<h4 class="counter"> <?= $totalCustomer ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div >
		<div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body">
							<div>
								<img style="width:120px;margin-left:44%;margin-top:30px;border-radius:6px;" alt="" src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>">
							</div>
							<div class="text-center" style="padding-bottom: 10px;">
								<h3> <?php echo $_SESSION['SMC_login_admin_name']; ?> </h3>
								<h5 class="designation"> FULL STACK WEB DEVELOPER </h5>
							</div>
							<a style="padding-left: 45%;" href="#"><button class="btn p-follow-btn pull-center" style="font-size:15px;" ><i class="fa fa-check">Following</i></button></a>
							<ul class="p-social-link pull-right">
								<li class="active">
									<a href="#">
										<i class="fa fa-github"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-stack-overflow"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>										
								<li class="active">
									<a href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</li>									
								<li class="active">
									<a href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</li>									
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div>
				<div>
					<div class="panel">
						<div class="panel-body">
							<div style="margin-bottom: 10px;padding-left:26%;">
								<a class="btn p-follow-btn" href="mailto:ecomtest@gmail.com"  style="margin-right: 15px;"> 
									<i class="fa fa-envelope"></i> &nbsp; ecomtest@gmail.com 
								</a>
								<a class="btn p-follow-btn" href="callto:9791465400" style="margin-right: 15px;"> 
									<i class="fa fa-phone"></i> &nbsp; +91 9791465400
								</a>
								<a class="btn p-follow-btn" href=""  style="margin-right: 15px;"> 
									<i class="fa fa-skype"></i> &nbsp; ecomtest
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-md-8">
			<div class="row">
				<div class="col-md-12">
					
					<section class="panel">
						<div class="carousel slide auto panel-body" id="c-slide">
							<ol class="carousel-indicators out">
								<li data-target="#c-slide" data-slide-to="0" class="active"></li>
								<li data-target="#c-slide" data-slide-to="1" class=""></li>
								<li data-target="#c-slide" data-slide-to="2" class=""></li>
								<li data-target="#c-slide" data-slide-to="3" class=""></li>
							</ol>
							<div class="carousel-inner">
								<div class="item text-center active">
									<h3> HANDPHONE STORE | ONLINE SHOPPING STORE </h3></br>
									<p class="text-muted">
										Welcome to our HandPhone Store website! We are dedicated to providing you with the latest and greatest electronic devices at competitive prices.</br>Our team is passionate about technology and we strive to offer a wide range of products to suit all your needs.
									</p>
								</div>
								<div class="item text-center">
									<h3> HANDPHONE STORE | ONLINE SHOPPING STORE </h3></br>
									<p class="text-muted">
										We understand that shopping for electronics can be overwhelming, so we have made it our mission to make the experience as smooth and enjoyable as possible.</br>Whether you're a tech enthusiast or a casual user, we have something for everyone.
									</p>
								</div>
								<div class="item text-center">
									<h3> HANDPHONE STORE | ONLINE SHOPPING STORE </h3></br>
									<p class="text-muted">
										In addition to our extensive product range, we also offer a variety of payment and shipping options.We want to make sure that buying from us is as convenient and hassle-free as possible.</br>Our team is always available to answer any questions or concerns that our customers may have.
									</p>
								</div>								
								<div class="item text-center">
									<h3> HANDPHONE STORE | ONLINE SHOPPING STORE </h3>
										Thank you for choosing our HandPhone Store website as your go-to destination for all things tech.</br>We hope to provide you with an exceptional shopping experience that you'll never forget!
									<p class="text-muted">
										
									</p>
								</div>
							</div>
							<a class="left carousel-control" href="#c-slide" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right carousel-control" href="#c-slide" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</section>
					
				</div>

			</div>
		</div>
	</div>
</div>
<!--=*= DASHBOARD SECTION END =*=-->
