<?php
    include "views/fixed/head.php";
	include "views/fixed/header.php";
	
?>
<!-- Login page content -->


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
							<h2>Login</h2>
							<!-- Form -->
							<form class="form" method="post" action="#">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email<span>*</span></label>
											<input type="email" name="email_nm" id="email">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Password<span>*</span></label>
											<input type="password" name="pass_nm" id="pass">
										</div>
									</div>
									

									<div class="btn_register">
										<input type="button" name="login_nm" id="login" class="btn" value="Login">
									</div>
								</div>
							</form>
							<!--/ End Form -->

							<div class="create_account">
								<h2>You don't have account?</h2>

								<div class="btn_register">
									<a href="register.php" class="btn">Create account</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End login -->
	



<?php
    include "views/fixed/footer.php";
?>