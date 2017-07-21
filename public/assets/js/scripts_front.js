$( document ).ready(function() {

    // Burger Menu

    $("#burger_menu").click(function(){
        $("#burger_menu").toggleClass('on');
        $("#nav_bar").toggleClass('open');
    });

    // Zoom image when click on the button

    $(".img_list div").click(function(){
        $("#my_zoom img").attr("src",$(this).children('img').attr("src"));
        $("#my_zoom").show();
    });

    $("#Close").click(function(){
        $("#my_zoom").hide();
    });


    // Replace all Text Area with ckeditor
    if ($(".super_editor").length){
        CKEDITOR.replace( 'textarea' );
    }

});
