$( document ).ready(function() {

	// Burger Menu

	$("#burger_menu").click(function(){
		$("#burger_menu").toggleClass('on');
		$("#nav_bar").toggleClass('open');
	});

	// Add active class to link when click

	$(function(){

    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.nav_bar li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

	});

	// Fake Loader Screen

	setTimeout(function(){
  		$('#loader').css("display","none");
	}, 2000);

});
