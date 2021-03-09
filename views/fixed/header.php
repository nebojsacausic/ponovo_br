<?php
//     ob_start();
//	session_start();
	include "/storage/ssd1/275/16327275/public_html/views/connection.php";
?>

<body class="js">
	
	<!-- Preloader
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	 </div>End Preloader -->
	
	
	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i> +060 801-582</li>
								<li><i class="ti-email"></i> support@babyroller.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<?php
									if(isset($_SESSION['users'])){
								?>
									<li><i class="ti-user"></i> <?php echo $_SESSION['users']->fName?></li>
									<li><i class="ti-power-off"></i><a href="logout.php">Logout</a></li>
								<?php
									}else{
								?>
									<li><i class="ti-user"></i> <a href="register.php">Register</a></li>
									<li><i class="ti-power-off"></i><a href="login.php">Login</a></li>
								<?php
									};
								?>
								
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.php"><img src="images/logo.png" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
				
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar shopping">

							<?php

								// $numCount = count($_SESSION['cart']);
								// $cont = '<a href="checkout.php" class="single-icon"><i class="ti-bag"></i> <span class="total-count">'.$numCount.'</span></a>';
								// echo $cont;
							?>
								
								<a href="checkout.php" class="single-icon"><i class="ti-bag"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav" id="nav_bar">
													<!--
													<li class="active"><a href="index.php">Home</a></li>
													<li><a href="products.php">Product</a></li>												
													<li><a href="#">Service</a></li>
													<li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
														<ul class="dropdown">
															<li><a href="shop-grid.html">Shop Grid</a></li>
															<li><a href="cart.html">Cart</a></li>
															<li><a href="checkout.html">Checkout</a></li>
														</ul>
													</li>
													<li><a href="#">Pages</a></li>								
													<li><a href="admin.php">Contact Us</a></li>-->
													<?php

														$query = "select * from menu";
														$result = $connection->query($query);
														$resFetch = $result->fetchAll();
														//var_dump($resFetch[0]->brand_name);
														$content = "";

														$selfFull = ($_SERVER['PHP_SELF']);
														$selfArray = explode("/", $selfFull);
														$self = $selfArray[count($selfArray)-1];
														//echo($self);

														foreach($resFetch as $res){
															if($res->href == $self){
																$content.="<li class='active'><a href=".$res->href.">".$res->title."</a></li>";
															}
															else{
																$content.="<li><a href=".$res->href.">".$res->title."</a></li>";
															}
															
														}
														echo $content;


														$admNav = "";
														if(isset($_SESSION['users'])){
															if($_SESSION['users']->role_id == "1"){
																if($self == "admin.php"){
																	$admNav.="<li class='active'><a href='admin.php'>Admin</a></li>";
																}
																else{
																	$admNav.="<li><a href='admin.php'>Admin</a></li>";
																}
																echo $admNav;
																
															}
															else if($_SESSION['users']->role_id == "2"){
																$admNav.="<li><a href='questionnaire.php'>Questionnaire</a></li>";
																echo $admNav;
															}
														};
													?>

												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->