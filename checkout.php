<?php
	//ob_start();
    include "views/fixed/head.php";
	include "views/fixed/header.php";
	include "views/connection.php";
?>

<!-- Breadcrumbs -->
<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

			
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="prod-on-cart">

							<?php

							if(isset($_SESSION['cart'])){
								include "views/connection.php";

								$arrObj = $_SESSION['cart'];
								$func = function ($product) {
									// var_dump($product);
									return $product['id'];
								};
								$arrId = array_map($func, $arrObj);
								//var_dump($arrId);
								$stringId = implode(',', $arrId);
								//var_dump($stringId);

								$array=array_map('intval', explode(',', $stringId));
								$array = implode("','",$array);

								//var_dump($array);

								$querry = "SELECT * FROM products INNER JOIN pictures ON products.id_product = pictures.id_product
											WHERE products.id_product IN ('".$array."')";
								$ressult = $connection->query($querry);
								$resFetch = $ressult->fetchAll();
								//echo json_encode($resFetch);
							}


								$cartSubtotal = null;
								$ispis = "";
								foreach($resFetch as $red){

									$kol = null;
									foreach ($_SESSION['cart'] as $key => $el) {
										if ($el['id'] === $red->id_product) {
											$kol = $_SESSION['cart'][$key]['kolicina'];
											break;
										}
									}

									//var_dump($kol);
									
									$totalPerProduct = $red->price*$kol;
									$cartSubtotal += $totalPerProduct;

									$ispis.='<tr>
												<td class="image" data-title="No"><img src="pictures/'.$red->href.'" alt="'.$red->href.'"></td>
												<td class="product-des" data-title="Description">
													<p class="product-name"><a href="#" name="product-naame">'.$red->product_name.'</a></p>
												</td>
												<td class="price" data-title="Price"><span name="product-price">$'.$red->price.'</span></td>
												<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<span>'.$kol.'</span>
													
												</div>
												<!--/ End Input Order -->
												<td class="total-amount" data-title="Total"><span>$'.$totalPerProduct.'</span></td>
												<td class="action" data-title="Remove"><a href="#" class="del-from-cart" data-id='.$red->id_product.'><i class="ti-trash remove-icon"></i></a></td>
											</tr>';
								}

								echo $ispis;
							
							?>

							

							
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">

							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<?php
											$cont = "
													<li>Shipping<span>Free</span></li>
													<li class='last'>You Pay<span>$$cartSubtotal</span></li>";

											echo $cont;
										?>
									</ul>
									<div class="button5">
										<input type="submit" name="make-order" id="make-order" value="Order">
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->



<?php
    include "views/fixed/footer.php";
?>