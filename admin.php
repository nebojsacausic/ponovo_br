<?php
	ob_start();
    include "views/fixed/head.php";
	include "views/fixed/header.php";
	include "views/connection.php";

	if(isset($_SESSION['users'])){
		if($_SESSION['users']->role_id != 1){
			header("Location: index.php");
		}
	}
	else{
		header("Location: index.php");
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
	<body>

		<div class="container">
			<div class="row">
				<div id="admin_panel">
					<div id="admin_sidebar">
						<a href="#" id="brand_btn" class="admin-btn" name="brand_nm">Brands</a>
						<a href="#" id="cat_btn" class="admin-btn" name="cat_nm">Categories</a>
						<a href="#" id="products_btn" class="admin-btn" name="sviProizvodi">Products</a>
						<a href="#" id="add_product" class="admin-btn" name="add_product_nm">Add new product</a>
						<a href="#" id="slider_pic_btn" class="admin-btn" name="slider_pic_nm">Slider picture</a>
						<a href="#" id="update_mail" class="admin-btn" name="update_mail">Update email</a>
						<a href="#" id="questionnaire" class="admin-btn" name="update_mail">Questionnaire</a>
					</div>

					<div id="admin_center">

					</div>
					

				</div>
			</div>
		</div>

		
	</body>
</html>

<?php
    include "views/fixed/footer.php";
?>