$(document).ready(function(){
    
    $("#brand_add").click(brandCheck);

})

function brandCheck(){
    console.log("dodajj");
    var entry_brand = $("#brand").val();
    console.log(entry_brand);

    //Regex
    var regBrand = /^[A-Z][a-z]{3,24}$/;


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
            url : "views/insertBrand.php",
            method : "post",
            dataType: "json",
            data : {
                brand : entry_brand,
                sent : true
            },
            success : function(data){
                console.log("Sve ok sa serverom");
                console.log(data);
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