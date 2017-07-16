$( document ).ready(function() {

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
