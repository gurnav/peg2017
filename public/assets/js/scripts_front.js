$( document ).ready(function() {

	// Zoom image when click on the button

	$(".img_list div").click(function(){
		$("#my_zoom img").attr("src",$(this).children('img').attr("src"));
		$("#my_zoom").show();
	});

	$("#Close").click(function(){
		$("#my_zoom").hide();
	});

	// Delete Something in the Front
	$(".Delete").click(function(){
       var q = confirm("Are you sure that you want to DELETE this ?");
       if (q == true) {
           document.location.href = $(this).val();
       }
   });


	// Replace all Text Area with ckeditor
	if ($(".super_editor").length){
		CKEDITOR.replace( 'textarea' );
	}

});
