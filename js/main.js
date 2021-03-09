$(document).ready(function() {
    console.log("");
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });


    
    $("#admin_sidebar .admin-btn").click(function(){
      $('#admin_sidebar .admin-btn').removeClass("active_nav");
      $(this).addClass("active_nav");
    });


    $("#nav_bar li").click(function(){
      $('#nav_bar li').removeClass("active");
      $(this).addClass("active");
    });
    

  
});

