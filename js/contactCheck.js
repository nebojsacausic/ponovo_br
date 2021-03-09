

function contactCheck(){
    var name = $("#message_name").val();
    var mail = $("#message_mail").val();
    var message = $("#message_text").val();
    

    var regName = /^[A-Z][a-z]{2,24}(\s[A-Z][a-z]{2,24})+$/;
    var regEmail = /^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/;
    
    var arrayErr = [];
    if(!regName.test(name)){
        $("#message_name").css({"border": "1px solid red"});
        arrayErr.push("Please enter full name!");
    }
    else{
        $("#message_name").css({"border": "none"});
    }

    if(!regEmail.test(mail)){
        $("#message_mail").css({"border": "1px solid red"});
        arrayErr.push("Invalid email format");
    }
    else{
        $("#message_mail").css({"border": "none"});
    }

    if(message == ""){
        $("#message_text").css({"border": "1px solid red"});
        arrayErr.push("Type your message");
    }
    else{
        $("#message_text").css({"border": "none"});
    }

    if(arrayErr.length > 0){
        return true;
    }
    else{
        return true;
    }


    // var mail = $("#message_mail").val();
    // var message = $("#message_text").val();

    // var regName = /^[A-Z][a-z]{2,24}(\s[A-Z][a-z]{2,24})+$/;
    

    // var arrayErr = [];
    // if(!name.test(regName)){
    //     $("#message_name").css({"border": "1px solid red"});
    //     arrayErr.push("Please enter full name!");
    //     //$("#fName").parent().append("<span>Ne valja ti ime</span>");
    // }
    // else{
    //     $("#message_name").css({"border": "none"});
    // }
}