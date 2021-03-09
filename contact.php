<?php
    include "views/fixed/head.php";
    include "views/fixed/header.php";
?>

<!-- Register page content -->

		<?php
			if(isset($_SESSION['users'])){
				if($_SESSION['users']->role_id == 2){?>


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
								<div id="message_cont">
									<div class="message_area">
										<h2>Contact us</h2>
										<!-- Form -->
										<form class="form" method="post" action="mail/mail.php" onsubmit="return contactCheck()">
											
												<div class='form_item'>
													<label>Full name <span>*</span></label></br>
													<input type="text" id="message_name" name="message_name" class="ele_forme_input">
												</div>
												<div class='form_item'>
													<label>Email <span>*</span></label></br>
													<input type="text" id="message_mail" name="message_mail" class="ele_forme_input">
												</div>
												<div class='form_item'>
													<label>Message <span>*</span></label></br>
													<textarea name="message_text" id="message_text" cols="30" rows="10"></textarea>
												</div>

												<div class="btn_register">
													<input type="submit" name="send_message" id="send_message" class="btn" value="Send">
												</div>
										</form>
										<!--/ End Form -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<?php
				}
				else{
					echo '<!DOCTYPE html>
							<html lang="en">
							<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<title>Document</title>
							</head>
								<body>
							
									<div class="container">
										<div class="row">
											<div class="message_contact">
												<h2>This page is only for users.</h2>
											</div>
										</div>
									</div>
							
									
								</body>
							</html>';
				}
			}
			else{
				echo '<!DOCTYPE html>
						<html lang="en">
						<head>
							<meta charset="UTF-8">
							<meta name="viewport" content="width=device-width, initial-scale=1.0">
							<title>Document</title>
						</head>
							<body>
						
								<div class="container">
									<div class="row">
										<div class="message_contact">
											<h2>Please login to send message.</h2>
										</div>
									</div>
								</div>
						
								
							</body>
						</html>';
			}
		?>

		
	



<?php
    include "views/fixed/footer.php";
?>