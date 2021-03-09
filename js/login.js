$(document).ready(function(){
    
    $("#login").click(loginCheck);

})

function loginCheck(){
    
    var entry_email, entry_pass;

    entry_email = $("#email").val();
    entry_pass = $("#pass").val();

    //Regex
    var regEmail = /^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/;
    var regPass = /^[\w\d\S]{8,30}$/;

    var arrayErr = [];

    if(!regEmail.test(entry_email)){
        $("#email").css({"border": "1px solid red"});
        arrayErr.push("Invalid format of email!");
    }
    else{
        $("#email").css({"border": "none"});
    }
    if(!regPass.test(entry_pass)){
        $("#pass").css({"border": "1px solid red"});
        arrayErr.push("Invalid format of password!");
    }
    else{
        $("#pass").css({"border": "none"});
    }


    if(arrayErr.length == 0){
        console.log("nema gresaka")
        $.ajax({
            url : "views/loginSesion.php",
            method : "post",
            dataType: "json",
            data : {
                email : entry_email,
                pass : entry_pass,
                sent : true
            },
            success : function(data){
                console.log("Sve ok sa serverom");
                console.log(data);
                if(data[0].role_id == "1"){
                    window.location.href = "admin.php";
                }
                else if(data[0].role_id == "2"){
                    window.location.href = "index.php";
                }
            },
            error : function(xhr, status, errorMsg){
                console.log("Nesto nije ok sa serverom");
            }
        })
    }
    else{
        for(var i=0; i<arrayErr.length;i++){
            console.log(arrayErr[i]);
        }
    }
}