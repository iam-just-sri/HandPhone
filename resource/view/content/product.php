<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [G]ET PRODUCT ID ===*=== ##
if(isset($_REQUEST['id']))
{
	$_SESSION['SSCF_product_product_id'] = $_REQUEST['id'];
}
## ===*=== [G]ET PRODUCT ID ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA BASED ON SESSION ID ===*=== ##
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "products";
$whereValue["id"] = $_SESSION['SSCF_product_product_id'];
$productResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
## ===*=== [F]ETCH PRODUCT DATA BASED ON SESSION ID ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA BASED ON SESSION ID ===*=== ##	
$columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
$columnName[1] = "product_master_image";
$columnName[2] = "id";
$tableName = "products";
$whereValue["id"] = $productResult[0]['id'];$paginate["POINT"] = 0;
$paginate["LIMIT"] = 1;
$relatedResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
## ===*=== [F]ETCH PRODUCT DATA BASED ON SESSION ID ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA FOR RELEVANT PRODUCT SLIDER ===*=== ##
$columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
$columnName = "*";
$tableName = "products";
$whereValue["subcategory_id"] = $productResult[0]['subcategory_id'];
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 7;
$relevantResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
## ===*=== [F]ETCH PRODUCT DATA FOR RELEVANT PRODUCT SLIDER ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA FOR FEATURED PRODUCT SLIDER ===*=== ##
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "products";
$whereValue["product_featured"] = "YES";
$featuredResult = $eloquent->selectData($columnName, $tableName, @$whereValue);	

#== FEATURE PRODUCT COUNT
$totalProducts = count($featuredResult);
## ===*=== [F]ETCH PRODUCT DATA FOR FEATURED PRODUCT SLIDER ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA FOR DYNAMIC BREADCRUMB ===*=== ##
$columnName = $tableName = $whereValue = null;
$columnName["1"] = "categories.id";
$columnName["2"] = "categories.category_name";
$columnName["3"] = "subcategories.id";
$columnName["4"] = "subcategories.subcategory_name";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["categories.id", "products.category_id"];
$onCondition["2"] = ["subcategories.id", "products.subcategory_id"];
$whereValue["products.id"] = $_SESSION['SSCF_product_product_id'];
$breadcrumbName = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy);
## ===*=== [F]ETCH PRODUCT DATA FOR DYNAMIC BREADCRUMB ===*=== ##
?>

<!--=*= PRODUCT SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="#"></a><?= @$breadcrumbName[0]['category_name']; ?></li>
				<li class="breadcrumb-item active" aria-current="page"><?= @$breadcrumbName[0]['subcategory_name']; ?></li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="product-single-container product-single-default">
					<div class="row">
						<div class="col-lg-7 col-md-6 product-single-gallery">
							<div class="product-slider-container product-item">
								
								<!--=*= PRODUCT IMAGE CAROUSEL START =*=-->
								<div class="product-single-carousel owl-carousel owl-theme">
									
									<?php
										foreach($relatedResult AS $eachImage)
										{
											echo'
											<div class="product-item">
												<img class="product-single-image" src="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachImage['product_master_image'] .'"
												data-zoom-image="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachImage['product_master_image'] .'">
											</div>									
											';
										}
									?>
									
								</div>
								<span class="prod-full-screen"><i class="icon-plus"></i></span>
								<!--=*= PRODUCT IMAGE CAROUSEL END =*=-->
							</div>
							
							<!--=*= PRODUCT IMAGE THUMBNAIL START =*=-->
							<div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
								
								<?php
									foreach($relatedResult AS $eachImage)
									{
										echo '
										<div class="col-3 owl-dot">
											<img src="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachImage['product_master_image'] .'"/>
										</div>										
										';
									}
								?>
								
							</div>
							<!--=*= PRODUCT IMAGE THUMBNAIL END =*=-->
						</div>
						<div class="col-lg-5 col-md-6">
							<div class="product-single-details">
								<h1 class="product-title">
									
									<?php
										#== PRODUCT NAME
										echo $productResult[0]['product_name'];
									?>
									
								</h1>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:80%"></span>
									</div>
								</div>
								<div class="price-box">
									<span class="product-price">
										
										<?php
											#== PRODUCT PRICE
											echo $GLOBALS['CURRENCY'] . " " . $productResult[0]['product_price'];
										?>
										
									</span>
								</div>
								<div class="product-desc">
									
									<?php 
										#== PRODUCT SUMMARY DATA
										echo $productResult[0]['product_summary'];
									?>
									
								</div>
								<div class="product-action product-all-icons">
									<div class="d-flex d-block d-inline">
										<div class="product-single-qty">
											<input class="horizontal-quantity form-control" type="text">
										</div>
										<form method="post" action="">
											<input type="hidden" name="cart_product_id" value="<?php echo $_SESSION['SSCF_product_product_id'];?>"/>
											<input type="hidden" name="cart_product_quantity" value="1"/>
											<button type="submit" name="add_to_cart" class="paction add-cart" title="Add to Cart" style="margin-left: 7px; padding-top: 6px;">
												<span>Add to Cart</span>
											</button>
										</form>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				<div class="product-single-tabs">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
							<div class="product-desc-content text-justify">
								
								<?php 
									#== PRODUCT DETAILS DATA
									$prodDescription = htmlspecialchars_decode($productResult[0]['product_details']);
									
									$getData = strip_tags($prodDescription, '<p><li>');
									$listItem = explode('<li>', $getData);
									
									echo $listItem[0];
									
									$onlyListItem = array_shift($listItem);
									
									foreach($listItem AS $eachList)
									{
										echo '<li style="list-style: none;"><i class="icon-ok"></i> '.$eachList.'</li>';
									}
								?>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="sidebar-overlay"></div>
			<div class="sidebar-toggle">
				<i class="icon-sliders"></i>
			</div>
			<aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
				<div class="sidebar-wrapper">
					<div class="widget widget-brand">
						<a href="#">
							<img src="public/assets/images/favicon/brand_logo_front.png" alt="brand name" style="height: 86px; width: 76px;">
						</a>
					</div>
					<div class="widget widget-info">
						<ul>
							<li>
								<i class="icon-shipping"></i>
								<h4>FREE<br>SHIPPING</h4>
							</li>
							<li>
								<i class="icon-us-dollar"></i>
								<h4>100% MONEY<br>BACK GUARANTEE</h4>
							</li>
							<li>
								<i class="icon-online-support"></i>
								<h4>ONLINE<br>SUPPORT 24/7</h4>
							</li>
						</ul>
					</div>
					
					<!--=*= FEATURED PRODUCT CONTENT START =*=-->
					<div class="widget widget-featured">
						<h3 class="widget-title">Featured Products</h3>
						<div class="widget-body">
							<div class="owl-carousel widget-featured-products">
								
								<?php
									foreach($featuredResult AS $index => $eachFeatured)
									{
										$i = $index % 3;
										$j = ($index + 1) % 3;
										
										if($i == '0')
										{
								?>
										<div class="product product-sm">
											
								<?php 
										} 
								?>
										
										<div class="product product-sm">
											<figure class="product-image-container">
												<p href="product.php" class="checkouts-image">
													<img src="<?= $GLOBALS['PRODUCT_DIRECTORY'] . $eachFeatured['product_master_image'] ?>" alt="product">
												</p>
											</figure>
											<div class="product-details">
												<h2 class="product-title">
													<p href="product.php"><?= $eachFeatured['product_name'] ?></p>
												</h2>
												<div class="ratings-container">
													<div class="product-ratings">
														<span class="ratings" style="width:80%"></span>
													</div>
												</div>
												<div class="price-box">
													<span class="product-price"><?= $GLOBALS['CURRENCY'] . " " . $eachFeatured['product_price'] ?></span>
												</div>
											</div>
										</div>
										
								<?php 
										if(($j == '0' && $index > 0) || $index + 1 == $totalProducts) 
										{
								?>
								
											</div>
										
								<?php 
										}
									}
								?>
								
							</div>
						</div>
						<!--=*= FEATURED PRODUCT CONTENT END =*=-->
					</div>
				</aside>
			</div>
		</div>
		
		<!--=*= RELEVANT PRODUCT SLIDER CONTENT START =*=-->
		<div class="featured-section">
			<div class="container">
				<h2 class="carousel-title">Relevant Products</h2>
				<div class="featured-products owl-carousel owl-theme owl-dots-top">
					
					<?php
						#== RELEVANT PRODUCT SLIDER
						foreach($relevantResult AS $eachrelevantProduct)
						{
							echo '
							<div class="product">
								<figure class="product-image-container">
									<a href="product.php?id=' .$eachrelevantProduct['id'] . ' " class="products-image">
										<img src=" '. $GLOBALS['PRODUCT_DIRECTORY'] . $eachrelevantProduct['product_master_image'] .' " alt="product">
									</a>
									<a href="product.php?id='. $eachrelevantProduct['id'] .' " class="btn-quickview">Quick View</a>
								</figure>
								<div class="product-details">
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:80%"></span>
										</div>
									</div>
									<h2 class="product-title">
										<a href="product.php?id=' .$eachrelevantProduct['id'] . ' ">'. $eachrelevantProduct['product_name'] .'</a>
									</h2>
									<div class="price-box">
										<span class="product-price">'. $GLOBALS['CURRENCY'] . " " . $eachrelevantProduct['product_price'] .'</span>
									</div>
									<div class="product-action">	
										<a href="product.php?id='. $eachrelevantProduct['id'] .'" class="paction add-cart" title="Add to Cart">
											<span>Add to Cart</span>
										</a>
									</div>
								</div>
							</div>
							';
						}
					?>
					
				</div>
			</div>
		</div>
		<!--=*= RELEVANT PRODUCT SLIDER CONTENT END =*=-->
	</div>
</main>
<!--=*= PRODUCT SECTION END =*=-->																																										