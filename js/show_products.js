$(document).ready(function() {

    
    $.ajax({
		url: "views/getProducts.php",
		method: "post",
		dateType: "json",
		data: {
			//category: "category"
		},
		success: function(data, textStatus, xhr){
			console.log(data);
            console.log(xhr.status)
            productsPrint(data);
		},
		error: function (err) {
			console.log(err);
		}
    });

    $(".del-from-cart").click(deleteFromCart);
});

function productsPrint(products){
    var content = "";

    products.forEach(function(p) {
        content += `<div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="pictures/${p.href}" alt="${p.alt}">
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        <a data-id="${p.id_product}" class="add_to_cart" title="Add to cart" href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">${p.product_name}</a></h3>
                                <div class="product-price">
                                    <span>$${p.price},00</span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });	
  

    $("#products_area").html(content);
    $(".add_to_cart").click(addToCart);
    
}


function addToCart(e){
    e.preventDefault();
    let idProductCart = $(this).data('id');


    $.ajax({
        type: "post",
        url: "views/cart.php",
        data: {
          idProduct: idProductCart,
          setCartSession : true
        },
        dataType: "json",
        success: function (data, text, xhr) {
          console.log(xhr);
        },
        error: function (xhr, status, err) {
          console.log(xhr);
        },
      });
}


function deleteFromCart(e){
    e.preventDefault();
    let idDelete = $(this).data('id');

    
    $.ajax({
        type: "post",
        url: "views/cart.php",
        data: {
          idDelete: idDelete,
          setIdDelete : true
        },
        dataType: "json",
        success: function (data, text, xhr) {
          console.log(xhr);
          console.log(data);
          currentOnCart(data)
        },
        error: function (xhr, status, err) {
          console.log(xhr);
        },
      });
}

function currentOnCart(data){
    if(data.length > 0){
        var cont = "";
        
        var uk;
        var ukupno = 0;
        data.forEach(function(p) {
            
            var br = parseInt(p.price);
            //console.log(p.kolicina);

            uk = br*p.kolicina;
            console.log(uk);
            ukupno += uk;
            console.log(ukupno);
            cont += `<tr>
                            <td class="image" data-title="No"><img src="pictures/${p.href}" alt="${p.alt}"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="#">${p.product_name}</a></p>
                            </td>
                            <td class="price" data-title="Price"><span>${p.price}</span></td>
                            <td class="qty" data-title="Qty"><!-- Input Order -->
                            <div class="input-group">
                                <span>${p.kolicina}</span>
                            </div>
                            <!--/ End Input Order -->
                            <td class="total-amount" class="tot-count" data-title="Total"><span>${p.price*p.kolicina}</span></td>
                            <td class="action" data-title="Remove"><a href="#" class="del-from-cart" data-id=${p.id_product}><i class="ti-trash remove-icon"></i></a></td>
                        </tr>`;
            
            
            
        });

        console.log(ukupno);

        

        $("#prod-on-cart").html(cont);
        $(".del-from-cart").click(deleteFromCart);
        $(".last span").text(ukupno);
        

    }
    else{
        $("#prod-on-cart").html("<h2>No products on cart</h2>");
    }
}