<?php
    include "views/fixed/head.php";
    include "views/fixed/header.php";
?>

<!-- Register page content -->


		<!-- Breadcrumbs -->

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="blog-single.html">registration</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start registration -->
		<section class="shop registration section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12">
						<div class="registration-form">
							<h2>Make Your registration Here</h2>
							<!-- Form -->
							<form class="form" method="post" action="#">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>First Name<span>*</span></label>
											<input type="text" name="fName_nm" id="fName">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Last Name<span>*</span></label>
											<input type="text" name="lName_nm" id="lName">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email<span>*</span></label>
											<input type="email" name="email_nm" id="email">
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address<span>*</span></label>
											<input type="text" name="address_nm" id="address">
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Choose a password<span>*</span></label>
											<input type="password" name="pass_nm" id="pass">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Repeat a passwod<span>*</span></label>
											<input type="password" name="pass_again_nm" id="pass_again">
										</div>
									</div>

									<div class="btn_register">
										<input type="button" name="register_nm" id="register" class="btn" value="Register">
									</div>
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End registration -->

		<!--/ End registration -->
	



<?php
    include "views/fixed/footer.php";
?>