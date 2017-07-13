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


	// Zoom image when click on the button

	$(".Zoom").click(function(){
		$("#my_zoom img").attr("src",$(this).parent().children('img').attr("src"));
		$("#my_zoom").show();
	});

	$("#Close").click(function(){
		$("#my_zoom").hide();
	});

	// Delete Something in the Back

	$(".Delete").click(function(){
		var q = confirm("Are you sure that you want to DELETE this ?");
		if (q == true) {
    		document.location.href = $(this).val();
		}
	});


	// Replace all Text Area with ckeditor
	if ($(".super_editor").length){
		// var CKEDITOR_BASEPATH = '127.0.0.1/esgi-geographic/public/assets/plugins';
		CKEDITOR.plugins.addExternal( 'imageuploader', '/esgi-geographic/public/assets/js/plugins/imageuploader/', 'plugin.js' );
		// extraPlugins needs to be set too.
		CKEDITOR.replace( 'textarea', {
  			extraPlugins: 'imageuploader'
		});
	}


	//Integration Stats
	if ($("#chartdiv").length){
	var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "USA",
    "visits": 2025
  }, {
    "country": "China",
    "visits": 1882
  }, {
    "country": "Japan",
    "visits": 1809
  }, {
    "country": "Germany",
    "visits": 1322
  }, {
    "country": "UK",
    "visits": 1122
  }, {
    "country": "France",
    "visits": 1114
  }, {
    "country": "India",
    "visits": 984
  }, {
    "country": "Spain",
    "visits": 711
  }, {
    "country": "Netherlands",
    "visits": 665
  }, {
    "country": "Russia",
    "visits": 580
  }, {
    "country": "South Korea",
    "visits": 443
  }, {
    "country": "Canada",
    "visits": 441
  }, {
    "country": "Brazil",
    "visits": 395
  } ],
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );
}

});
