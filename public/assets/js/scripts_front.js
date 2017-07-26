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
	// Delete Something in the Front
	$(".Delete").click(function(){
       var q = confirm("Are you sure that you want to DELETE this ?");
       if (q == true) {
           document.location.href = $(this).val();
       }
   });

    $("#Close").click(function(){
        $("#my_zoom").hide();
    });


    // Replace all Text Area with ckeditor
    if ($(".super_editor").length){
        CKEDITOR.replace( 'textarea' );
        CKEDITOR.config.entities = false;
        CKEDITOR.config.entities_latin = false;
    }

});
