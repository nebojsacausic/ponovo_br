$(document).ready(function() {
	
    brandAjax();
    $("#brand_btn").click(brandAjax);
    $("#cat_btn").click(categoryAjax);
    $("#add_product").click(addProduct);
    $("#products_btn").click(productsAjax);
    $("#slider_pic_btn").click(sliderAjax);
    $("#update_mail").click(updateMail);
    $("#questionnaire").click(questionnaireAjax);
});

//----------------------SENDING REQUESTS-------------------------


function questionnaireAjax(){
    $.ajax({
		url: "views/getQuestions.php",
		method: "post",
		dateType: "json",
		success: function(data, textStatus, xhr){
			questionnaireSend(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}




function updateMail(){
    $.ajax({
		url: "views/contactSend.php",
		method: "post",
		dateType: "json",
        data : {
            updMail : true
        },
		success: function(data, textStatus, xhr){
			fillUpdateMail(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}




//Brands request
function brandAjax(){

    $.ajax({
		url: "brands.php",
		method: "post",
		dateType: "json",
		data: {
			brand: "brand"
		},
		success: function(data, textStatus, xhr){
			//console.log(data);
            //console.log(xhr.status)
            admin_brand(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}

//Slider request
function sliderAjax(){

    $.ajax({
		url: "views/slider.php",
		method: "post",
        dateType: "json",
		success: function(data, textStatus, xhr){
            console.log(data);
            sliderContent(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}

function sliderContent(data){
    var content = "";
    var br = 1;
    content += `
    <div class="slider_pics">
    <h3 style="text-align:center;">Slider pictures</h3></br>
    <div class="slider_list">

        <table cellpadding='2'>
            <tr>
                <th>N</th>
                <th>Picture</th>
                <th>Delete</th>						
            </tr>`;
        
            data.forEach(function(p) {
                content += `<tr>
                                <td>${br++}</td>
                                <td><img src="pictures/slider/${p.href}" alt="${p.alt}"/></td>
                                <td><a href='#' class='delete' data-id='${p.id_slider}'>Delete</a></td>
                            </tr>`;
            });
            



        content += `</table>
    </div>
    </div>
            <div id="center_right">
                <div class="slider_center_right">
                <form class="form" method="post" action="views/sliderCrud.php" onsubmit="return regexSlider()" enctype="multipart/form-data">
                    <div class="admin_row">
                        <div class="col_admin_row">
							<div class="form-group">
								<h5>Add slider pics</h5>
								<input type="file" name="slider_pic_nm" id="slicer_pic_id">
							</div>
                        </div>
                    </div>
							
						<div class="btn_register">
							<input type="submit" name="slider_pic_btn" id="add_slider_pic" class="btn" value="ADD">
						</div>
                </form>
                </div>
            </div>`;

    $("#admin_center").html(content);

    //Delete slider item
    $(".delete").click(deleteSlider);
}


function deleteSlider(){
    var idDelete = $(this).data("id");
    console.log(idDelete);

    $.ajax({
        url: "views/sliderCrud.php",
        method: "post",
        dateType: "json",
        data: {
            idDelete: idDelete		
        },
        success: function(data){
            // console.log(data)
            sliderAjax();
        },
        error: function (x,z,y) {
            console.log(x,z,y);
        }
    })
}




//Categories request
function categoryAjax(){
    console.log("oooo")
    $.ajax({
		url: "categories.php",
		method: "post",
		dateType: "json",
		data: {
			category: "category"
		},
		success: function(data, textStatus, xhr){
			console.log(data);
            console.log(xhr.status)
            admin_category(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}

function productsAjax(){
    
    $.ajax({
		url: "views/getProducts.php",
		method: "post",
		dateType: "json",
		success: function(data, textStatus, xhr){
			console.log(data);
            //console.log(xhr.status)
            listProducts(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
}


function listProducts(data){
    var content = "";
    content += `
    
    <div class="product_list">
        <h3 style="text-align:center;">Products</h3>

        <table cellpadding='2'>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Active</th>
                <th>Update</th>
                <th>Delete</th>						
            </tr>
    `;
    data.forEach(function(p) {
        content += `<tr>
                    <td>${p.id_product}</td>
                    <td class='naziv'>${p.product_name}</td>
                    <td class='brand'>${p.brand_name}</td>
                    <td class='cat'>${p.category}</td>
                    <td class='act'>${p.active}</td>
                    <td><a href='#' class='update' data-id='${p.id_product}'>Update</a></td>
                    <td><a href='#' class='delete' data-id='${p.id_product}'>Delete</a></td>
                    </tr>`;
        });	

    content +=    
        ` </table>
            </div>`;

    $("#admin_center").html(content);
    $(".delete").click(deleteProduct);
    $(".update").click(updateProduct);
}
//---------------UPDATE PRODUCT--------------------


function updateProduct(){
    var idUpdate = $(this).data("id");
    console.log(idUpdate);

    $.ajax({
        url : "views/productsCrud.php",
        method : "post",
        dataType: "json",
        data : {
            idUpdate : idUpdate,
            sentUpdate : true
        },
        success : function(prod){
            //console.log(prod);
            listUpdateProduct(prod);
            productsUpdateBrand(prod.id_brand);
            productsUpdateCategories(prod.id_category);
            console.log(prod.id_brand)
        },
        error : function(xhr, status, errorMsg){
            console.log("Nesto nije ok sa serverom");
        }
    });
}

function productsUpdateBrand(brandId){
    $.ajax({
        url: "brands.php",
        method: "post",
        dateType: "json",
        data: {
            brand: "brand",
        },
        success: function(brands, textStatus, xhr){
            console.log(brands);
            console.log(xhr.status)
            dropdownBrands(brands, brandId);
        },
        error: function (err) {
            console.log(err);
        }
    });
}

function productsUpdateCategories(catId){
    $.ajax({
		url: "categories.php",
		method: "post",
		dateType: "json",
		data: {
			category: "category"
		},
		success: function(categories, textStatus, xhr){
			//console.log(data);
            console.log(xhr.status)
            dropdownCat(categories, catId);
		},
		error: function (err) {
			console.log(err);
		}
    });
}






function listUpdateProduct(data){
    console.log(data);
    var content = "";

    content += 
    `<div class='add_new_prod'><h3 style="text-align:center;">Update product</h3>
        <form class="form" method="post" action="views/productsCrud.php" id="myForm" onsubmit="return regexProdUpdate()" enctype="multipart/form-data">
            <input type="hidden" name="finalUpdateId" value="${data.id_product}">
            <div class='form_item'>
                <label>Title: <span>*</span></label></br>
                <input type="text" id="add_item_title" name="add_item_nm" class="ele_forme_input" value="${data.product_name}">
            </div>
            <div class='form_item'>
                <label>Price: <span>*</span></label></br>
                <input type="number" id="add_item_price" name="item_price_nm" class="ele_forme_input" value="${data.price}">
            </div>

            <div class="add_item_dropdown" id="add_item_category">
            </div>


            <div class="add_item_dropdown" id="add_item_brand">
            </div>

            <div class="add_item_active" id='add_active_id'>
                <table cellpadding='2'>
                    <tr>
                        <td>Active:</td>
                        <td>Not active:</td>						
                    </tr>
                    <tr>
                        <td><input type="radio" value="1" name="active_nm" class="" checked="checked"></td>
                        <td><input type="radio" value="0" name="active_nm" class=""></td>						
                    </tr>
                </table>
            </div>

            <div class='form_item'>
                <label>Description: <span>*</span></label></br>
                <textarea name="item_description" class="ele_forme_input" id="add_item_description">${data.description}</textarea>
            </div>

            <div class='form_item_pic'>
                <label>Picture:</label></br>
                <img src="pictures/${data.href}" alt="${data.alt}"/>
                <input type="file" name="update_pic_nm" id="update_add_pic" class="add_item_pic">
            </div>

            <div class='form_item'>
                <div class="btn_add_item">
                    <input type="submit" name="update_item_btn" id="update_item_button" class="btn" value="Update">
                </div>
            </div>
        </form>
    </div>`;

    $("#admin_center").html(content);

    //var strUser = e.val(data.id_brand);
    //var opt = e.options[e.selectedIndex];
    //e.val(data.id_brand);
    //console.log(strUser);



    //Ajax request for brands dropdown
    // $.ajax({
	// 	url: "brands.php",
	// 	method: "post",
	// 	dateType: "json",
	// 	data: {
	// 		brand: "brand",
	// 	},
	// 	success: function(data, textStatus, xhr){
	// 		//console.log(data);
    //         console.log(xhr.status)
    //         dropdownBrands(data);
	// 	},
	// 	error: function (err) {
	// 		console.log(err);
	// 	}
    // });
    
    //Ajax request for category dropdown
    

    
}








function deleteProduct(){
    var idDelete = $(this).data("id");
        console.log(idDelete)

        $.ajax({
            url: "views/productsCrud.php",
            method: "post",
            dateType: "json",
            data: {
                idDelete: idDelete		
            },
            success: function(data){
                alert(data.message);
                productsAjax(data);
            },
            error: function (x,z,y) {
                console.log(x,z,y);
            }
        })
}


function addProduct(){
    var content = "";

    content += 
    `<div class='add_new_prod'><h3 style="text-align:center;">Add new item</h3>
        <form class="form" method="post" action="views/productsCrud.php" id="myForm" onsubmit="return regexProducts()" enctype="multipart/form-data">
            <div class='form_item'>
                <label>Title: <span>*</span></label></br>
                <input type="text" id="add_item_title" name="add_item_nm" class="ele_forme_input">
            </div>
            <div class='form_item'>
                <label>Price: <span>*</span></label></br>
                <input type="number" id="add_item_price" name="item_price_nm" class="ele_forme_input">
            </div>

            <div class="add_item_dropdown" id="add_item_category">;
            </div>


            <div class="add_item_dropdown" id="add_item_brand">
            </div>

            <div class="add_item_active" id='add_active_id'>
                <table cellpadding='2'>
                    <tr>
                        <td>Active:</td>
                        <td>Not active:</td>						
                    </tr>
                    <tr>
                        <td><input type="radio" value="1" name="active_nm" class="" checked="checked"></td>
                        <td><input type="radio" value="0" name="active_nm" class=""></td>						
                    </tr>
                </table>
            </div>

            <div class='form_item'>
                <label>Description: <span>*</span></label></br>
                <textarea name="item_description" class="ele_forme_input" id="add_item_description"> </textarea>
            </div>

            <div class='form_item_pic'>
                <label>Picture:</label></br>
                <input type="file" name="pic_nm" id="add_pic" class="add_item_pic">
            </div>

            <div class='form_item'>
                <div class="btn_add_item">
                    <input type="submit" name="add_item_btn" id="add_item_button" class="btn" value="Confirm">
                </div>
            </div>
        </form>
    </div>`;

    $("#admin_center").html(content);

    //$("#add_item_button").click(productsCheck);


    //Ajax request for brands dropdown
    $.ajax({
		url: "brands.php",
		method: "post",
		dateType: "json",
		data: {
			brand: "brand"
		},
		success: function(data, textStatus, xhr){
			//console.log(data);
            console.log(xhr.status)
            dropdownBrands(data);
		},
		error: function (err) {
			console.log(err);
		}
    });
    
    //Ajax request for category dropdown
    $.ajax({
		url: "categories.php",
		method: "post",
		dateType: "json",
		data: {
			category: "category"
		},
		success: function(data, textStatus, xhr){
			//console.log(data);
            console.log(xhr.status)
            dropdownCat(data);
		},
		error: function (err) {
			console.log(err);
		}
    });

}

function dropdownBrands(brands, brandId){
    var content = `<label>Brands: <span>*</span></label></br>
    <select class="ele_forme_input" name="brands_nm" id="brand_dropdown_id"><option value='0'></option>`;

    brands.forEach( function(b) {
        if(b.id_brand == brandId){
            content += `<option value='${b.id_brand}' selected>${b.brand_name}</option>`;
        }
        else{
            content += `<option value='${b.id_brand}'>${b.brand_name}</option>`;
        }
    
    });
    content += `</select>`;

    $("#add_item_brand").html(content);
}

function dropdownCat(categories, catId){
    var content = `<label>Categories: <span>*</span></label></br>
    <select class="ele_forme_input" name="categories_nm"><option value='0'></option>`;

    categories.forEach( function(c) {
        //console.log(c.id_category)
        if(c.id_category == catId){
            content += `<option value='${c.id_category}' selected>${c.category}</option>`;
        }
        else{
            content += `<option value='${c.id_category}'>${c.category}</option>`;
        }
    });
    content += `</select>`;

    $("#add_item_category").html(content);
}








//---------- CATEGORIES---------------

function admin_category(data){
    var content = "";
    var br = 1;
    content += `
    <div id="center_left">
        <h3 style="text-align:center;">Categories</h3></br>
        <div class="categories_list">

            <table cellpadding='2'>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Update</th>
                    <th>Delete</th>						
                </tr>
        `;
    data.forEach(function(p) {
        content += `<tr>
                    <td>${br++}</td>
                    <td class='naziv'>${p.category}</td>
                    <td><a href='#' class='update' data-id='${p.id_category}'>Update</a></td>
                    <td><a href='#' class='delete' data-id='${p.id_category}'>Delete</a></td>
                    </tr>`;
        });	

    content +=    
        ` </table>
        </div> 
    </div>
            <div id="center_right">
                <form class="form" method="post" action="#">
                    <div class="admin_row">
                        <div class="col_admin_row">
							<div class="form-group">
								<h5>Add new category </h5>
								<input type="text" name="category_nm" id="category">
							</div>
                        </div>
                    </div>
							
						<div class="btn_register">
							<input type="button" name="category_btn_nm" id="category_add" class="btn" value="ADD">
						</div>
                </form>
                <div id="right_update"></div>
            </div>`;

    $("#admin_center").html(content);
    $("#category_add").click(categoryCheck);

    
    //------------------DELETE CATEGORIES--------------------
    $(".delete").click(deleteCategory);

    //-------------------UPDATE CATEGORIES-----------------
    
    $(".update").click(updateCategories);
};
//Regular expression on categories adding
function categoryCheck(){
    console.log("dodajj");
    var entry_category = $("#category").val();
    console.log(entry_category);

    //Regex
    var regCategory = /^[A-Z][a-z]{2,12}(\s[A-Z][a-z]{2,12})?$/;
    ///^[A-Z][a-z]{3,24}(\s[A-Z][a-z]{3,24})?$/;


    var arrayErr = [];
    //Regex front test
    if(!regCategory.test(entry_category)){
        $("#category").css({"border": "1px solid red"});
        arrayErr.push("Invalid format of brand name!");
        //$("#fName").parent().append("<span>Ne valja ti ime</span>");
    }
    else{
        $("#category").css({"border": "none"});
    }

    if(arrayErr.length == 0){
        console.log("nema gresaka")
        $.ajax({
            url : "views/categoriesCrud.php",
            method : "post",
            dataType: "json",
            data : {
                category : entry_category,
                sent : true
            },
            success : function(data){
                alert(data.message);
                categoryAjax(data);
            },
            error : function(xhr, status, errorMsg){
                console.log("Nesto nije ok sa serverom");
            }
        });
    }
    else{
        for(var i=0; i<arrayErr.length;i++){
            console.log(arrayErr[i]);
        };
    }
}


function deleteCategory(){
    var idDelete = $(this).data("id");
    console.log(idDelete)

    $.ajax({
        url: "views/categoriesCrud.php",
        method: "post",
        dateType: "json",
        data: {
            idDelete: idDelete		
        },
        success: function(data){
            alert(data.message);
            categoryAjax(data);
        },
        error: function (x,z,y) {
            console.log(x,z,y);
        }
    })
}

function updateCategories(){
    var idUpdate = $(this).data("id");
    var category = $(this).parent().parent().find("td.naziv").text();

    contentUpdate = `<form class="form" method="post" action="#">
                            <div class="admin_row">
                                <div class="col_admin_row">
                                    <div class="form-group">
                                        <h5>New category name</h5>
                                        <input type="text" name="update_category_nm" id="update_category">
                                    </div>
                                </div>
                            </div>

                            <div class="btn_register">
                                <input type="button" name="category_btn_nm" id="category_update_btn" class="btn" value="UPDATE">
                            </div>
                        </form>`;
    
    $("#right_update").html(contentUpdate);
    $("#update_category").val(category);

    $("#category_update_btn").click(function(){
        var entry_category = $("#update_category").val();
        console.log(entry_category);
        console.log(idUpdate);

        $.ajax({
            url : "views/categoriesCrud.php",
            method : "post",
            dataType: "json",
            data : {
                category : entry_category,
                id_category : idUpdate,
                sentUpdate : true
            },
            success : function(data){
                alert(data.message);
                categoryAjax(data);
            },
            error : function(xhr, status, errorMsg){
                console.log("Nesto nije ok sa serverom");
            }
        });
    })
}



//---------- BRANDS---------------

function admin_brand(data){
    var content = "";
    var br = 1;
    content += `
    <div id="center_left">
        <h3 style="text-align:center;">Brands</h3></br>
        <div class="brands_list">

            <table cellpadding='2'>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Update</th>
                    <th>Delete</th>						
                </tr>
        `;

    

    data.forEach(function(p) {
        content += `<tr>
                    <td>${br++}</td>
                    <td class='naziv'>${p.brand_name}</td>
                    <td><a href='#' class='update' data-id='${p.id_brand}'>Update</a></td>
                    <td><a href='#' class='delete' data-id='${p.id_brand}'>Delete</a></td>
                    </tr>`;
        });	
    content +=    
        `       </table>
            </div>
        </div>
        
        <div id="center_right">
            <form class="form" method="post" action="#">
                <div class="admin_row">
                    <div class="col_admin_row">
                        <div class="form-group">
                            <h5>Add new brand</h5>
                            <input type="text" name="brand_nm" id="brand">
                        </div>
                    </div>
                </div>

                <div class="btn_register">
                    <input type="button" name="brand_btn_nm" id="brand_add" class="btn" value="ADD">
                </div>
            </form>
            <div id="right_update"></div>
        </div>`;

    $("#admin_center").html(content);
    $("#brand_add").click(brandCheck);
    $(".delete").click(deleteBrand);
    $(".update").click(updateBrand);

    
};
//Regular expression on brands adding
function brandCheck(){
    console.log("dodajj");
    var entry_brand = $("#brand").val();
    console.log(entry_brand);

    //Regex
    var regBrand = /^[A-Z][a-z]{2,12}(\s[A-Z][a-z]{2,12})?$/;


    var arrayErr = [];
    //Regex front test
    if(!regBrand.test(entry_brand)){
        $("#brand").css({"border": "1px solid red"});
        arrayErr.push("Invalid format of brand name!");
        //$("#fName").parent().append("<span>Ne valja ti ime</span>");
    }
    else{
        $("#brand").css({"border": "none"});
    }

    if(arrayErr.length == 0){
        console.log("nema gresaka")
        $.ajax({
            url : "views/brandCrud.php",
            method : "post",
            dataType: "json",
            data : {
                brand : entry_brand,
                sent : true
            },
            success : function(data){
                alert(data.message);
                brandAjax(data);
            },
            error : function(xhr, status, errorMsg){
                console.log("Nesto nije ok sa serverom");
            }
        });
    }
    else{
        for(var i=0; i<arrayErr.length;i++){
            console.log(arrayErr[i]);
        };
    }
}

//------------------DELETE BRAND--------------------
function deleteBrand(){
    var idDelete = $(this).data("id");
        console.log(idDelete)

        $.ajax({
            url: "views/brandCrud.php",
            method: "post",
            dateType: "json",
            data: {
                idDelete: idDelete		
            },
            success: function(data){
                alert(data.message);
                brandAjax(data);
            },
            error: function (x,z,y) {
                console.log(x,z,y);
            }
        })
}

//-------------------UPDATE BRAND-----------------

function updateBrand(){
    var idUpdate = $(this).data("id");
        var brand = $(this).parent().parent().find("td.naziv").text();

        contentUpdate = `<form class="form" method="post" action="#">
                                <div class="admin_row">
                                    <div class="col_admin_row">
                                        <div class="form-group">
                                            <h5>New brand name</h5>
                                            <input type="text" name="update_brand_nm" id="update_brand">
                                        </div>
                                    </div>
                                </div>

                                <div class="btn_register">
                                <input type="button" name="brand_btn_nm" id="brand_update_btn" class="btn" value="UPDATE">
                                </div>
                            </form>`;
        
    $("#right_update").html(contentUpdate);
    $("#update_brand").val(brand);

    $("#brand_update_btn").click(function(){
        var entry_brand = $("#update_brand").val();
        console.log(entry_brand);
        console.log(idUpdate);

        $.ajax({
            url : "views/brandCrud.php",
            method : "post",
            dataType: "json",
            data : {
                brand : entry_brand,
                id_brand : idUpdate,
                sentUpdate : true
            },
            success : function(data){
                alert(data.message);
                brandAjax(data);
            },
            error : function(xhr, status, errorMsg){
                console.log("Nesto nije ok sa serverom");
            }
        });
    })
}


function fillUpdateMail(data){
    content = `<form class="form update-mail">
                <div class="admin_row">
                    <div class="col_admin_row">
                        <div class="form-group">
                            <h5>Update email</h5>
                            <input type="text" name="update_email" id="update_email" value="${data.email}">
                        </div>
                    </div>
                </div>

                <div class="btn_register">
                <input type="button" name="update-admin-mail" id="update-admin-mail" class="btn" value="UPDATE">
                </div>
            </form>`;
    
    
    $("#admin_center").html(content);
    $("#update-admin-mail").click(updateAdminMail);
}

function updateAdminMail(){
    var email = $("#update_email").val();
    
    $.ajax({
        url : "views/contactSend.php",
        method : "post",
        dataType: "json",
        data : {
            email : email,
            update_admin_email : true
        },
        success : function(data){
            alert(data.message);
            //brandAjax(data);
        },
        error : function(xhr, status, errorMsg){
            console.log("Nesto nije ok sa serverom");
        }
    });
}



function questionnaireSend(questions){
    //console.log(question)
    var content = `<div id="center_left">
    <h3 style="text-align:center;">Question</h3></br>
    <div class="brands_list">

        <table cellpadding='2'>
            <tr>
                <th>Question</th>
                <th>Active</th>						
            </tr>`;

            questions.forEach(function(question) {

                if(question.active == 1){
                    content += `<tr>
                                <td>${question.question}</td>
                                <td><input type='radio' name='question_nm' checked value='${question.id_questionnaire}'></td>
                            </tr> `;
                }
                else{
                    content += `<tr>
                                <td>${question.question}</td>
                                <td><input type='radio' name='question_nm' value='${question.id_questionnaire}'></td>
                            </tr> `;
                }
                });	

        content += `</table>
        </div>
    </div>
                
                <div id="center_right">
                    <form class="form" method="post" action="#">
                        <div class="btn_register">
                            <input type="button" id="active_question" class="btn" value="Choose">
                        </div>
                        <div class="btn_register">
                            <input type="button" name="new_question_form" id="new_question_form" class="btn" value="ADD NEW QUESTION">
                        </div>
                    </form>
                </div>`;
        
        $("#admin_center").html(content);
        $("#new_question_form").click(addNewQuestion);
        $("#active_question").click(active_question);
}

function active_question(){
    var activeId = $('input[name="question_nm"]:checked').val();
    
    $.ajax({
        url : "views/insertQuestionnaire.php",
        method : "post",
        dataType: "json",
        data : {
            activeId : activeId,
            chooseActive : true
        },
        success : function(data){
            alert(data.message);
            window.location.href = "admin.php";
        },
        error : function(xhr, status, errorMsg){
            console.log(xhr);
            console.log("Nesto nije ok sa serverom");
        }
    });
}


function addNewQuestion(){
    var newCont = `<form class="form update-mail">
                    <div class="admin_row">
                        <div class="col_admin_row">
                            <div class="form-group">
                                <h5>Type new question</h5>
                                <input type="text" name="new_quest_nm" id="new_quest_id">
                                <div class='answers_cl'>
                                    <h5>Type answers</h5>
                                    <input type="text" name="answer_nm[]" class="new_answer">
                                </div>
                                <input type="button" name="add_input" id="add_input" value="New answer" class="btn">
                            </div>
                        </div>
                    </div>

                    <div class="btn_register">
                        <input type="button" name="send_new_question" id="send_new_question" class="btn" value="ADD">
                    </div>
                </form>`;

    $("#admin_center").html(newCont);


    var answerArr = [];
    $("#add_input").click(function(){
        $(".new_answer:last").after("<input type='text' name='answer_nm[]' class='new_answer'>");
        
    })

    $("#send_new_question").click(function(){

        var arr = [];
        arr = $("input[name='answer_nm[]']");

        Array.from(arr).forEach(el => {
            answerArr.push(el.value);
            
        });

        //console.log(answerArr);
        
        var newQuestion = $("#new_quest_id").val();

        var errArr = 0;
        if(newQuestion == ""){
            errArr++;
            $("#new_quest_id").css({"border": "1px solid red"});
        }

        newArrAnswer = [];
        $.each(answerArr, function( index, value ) {
            if(value != ""){
                newArrAnswer.push(value);
            }
        });

        console.log(newArrAnswer);

        if(errArr > 0){
            console.log("Ne valja");
        }
        else{
            $.ajax({
                url : "views/insertQuestionnaire.php",
                method : "post",
                dataType: "json",
                data : {
                    newQuestion : newQuestion,
                    newArrAnswer : newArrAnswer,
                    newQuestSent : true
                },
                success : function(data){
                    alert(data.message);
                    //brandAjax(data);
                },
                error : function(xhr, status, errorMsg){
                    console.log(xhr);
                    console.log("Nesto nije ok sa serverom");
                }
            });

        }
        
    })


    
    // $(".form-group .new_answer").blur(function(){
    //     $(".new_answer:last").after("<input type='text' name='answer_nm[]' class='new_answer'>");
    //     var answerArr = $("input[name='answer_nm[]']").map(function(){return $(this).val();}).get();
    //     console.log(answerArr)
    // })
}