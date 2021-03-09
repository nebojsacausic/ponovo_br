$(document).ready(function() {
    
    //$("#add_item_button").submit(provjera);

    regexSlider();
   
});

function regexSlider(){
    
    var entry_picture = $("#slicer_pic_id").val();
    var regPic = /^.*\.(jpg|jpeg|png)$/;

    //Regex front test
    if(!regPic.test(entry_picture)){
        console.log(entry_picture);
        $("#slicer_pic_id").css({"border": "1px solid red"});
        return false;
    }


    return true;
}