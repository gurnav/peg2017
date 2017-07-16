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

    if ($("#chartdiv1").length){
        var chart = AmCharts.makeChart("chartdiv1", {
            "type": "serial",
            "theme": "light",
            "marginRight": 40,
            "marginLeft": 40,
            "autoMarginOffset": 20,
            "mouseWheelZoomEnabled":true,
            "dataDateFormat": "YYYY-MM-DD",
            "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "position": "left",
                "ignoreAxisWidth":true
            }],
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "graphs": [{
                "id": "g1",
                "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                },
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "title": "red line",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
            }],
            "chartScrollbar": {
                "graph": "g1",
                "oppositeAxis":false,
                "offset":30,
                "scrollbarHeight": 80,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount":true,
                "color":"#AAAAAA"
            },
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha":1,
                "cursorColor":"#258cbb",
                "limitToGraph":"g1",
                "valueLineAlpha":0.2,
                "valueZoomable":true
            },
            "valueScrollbar":{
                "oppositeAxis":false,
                "offset":50,
                "scrollbarHeight":10
            },
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true
            },
            "dataProvider": [{
                "date": "2016-07-27",
                "value": 13
            }, {
                "date": "2016-07-28",
                "value": 11
            }, {
                "date": "2016-07-29",
                "value": 15
            }, {
                "date": "2016-07-30",
                "value": 16
            }, {
                "date": "2016-07-31",
                "value": 18
            }, {
                "date": "2016-08-01",
                "value": 13
            }, {
                "date": "2016-08-02",
                "value": 22
            }, {
                "date": "2016-08-03",
                "value": 23
            }, {
                "date": "2016-08-04",
                "value": 20
            }, {
                "date": "2016-08-05",
                "value": 17
            }, {
                "date": "2016-08-06",
                "value": 16
            }, {
                "date": "2016-08-07",
                "value": 18
            }, {
                "date": "2016-08-08",
                "value": 21
            }, {
                "date": "2016-08-09",
                "value": 26
            }, {
                "date": "2016-08-10",
                "value": 24
            }, {
                "date": "2016-08-11",
                "value": 29
            }, {
                "date": "2016-08-12",
                "value": 32
            }, {
                "date": "2016-08-13",
                "value": 18
            }, {
                "date": "2016-08-14",
                "value": 24
            }, {
                "date": "2016-08-15",
                "value": 22
            }, {
                "date": "2016-08-16",
                "value": 18
            }, {
                "date": "2016-08-17",
                "value": 19
            }, {
                "date": "2016-08-18",
                "value": 14
            }, {
                "date": "2016-08-19",
                "value": 15
            }, {
                "date": "2016-08-20",
                "value": 12
            }, {
                "date": "2016-08-21",
                "value": 8
            }, {
                "date": "2016-08-22",
                "value": 9
            }, {
                "date": "2016-08-23",
                "value": 8
            }, {
                "date": "2016-08-24",
                "value": 7
            }, {
                "date": "2016-08-25",
                "value": 5
            }, {
                "date": "2016-08-26",
                "value": 11
            }, {
                "date": "2016-08-27",
                "value": 13
            }, {
                "date": "2016-08-28",
                "value": 18
            }, {
                "date": "2016-08-29",
                "value": 20
            }, {
                "date": "2016-08-30",
                "value": 29
            }, {
                "date": "2016-08-31",
                "value": 33
            }, {
                "date": "2016-09-01",
                "value": 42
            }, {
                "date": "2016-09-02",
                "value": 35
            }, {
                "date": "2016-09-03",
                "value": 31
            }, {
                "date": "2016-09-04",
                "value": 47
            }, {
                "date": "2016-09-05",
                "value": 52
            }, {
                "date": "2016-09-06",
                "value": 46
            }, {
                "date": "2016-09-07",
                "value": 41
            }, {
                "date": "2016-09-08",
                "value": 43
            }, {
                "date": "2016-09-09",
                "value": 40
            }, {
                "date": "2016-09-10",
                "value": 39
            }, {
                "date": "2016-09-11",
                "value": 34
            }, {
                "date": "2016-09-12",
                "value": 29
            }, {
                "date": "2016-09-13",
                "value": 34
            }, {
                "date": "2016-09-14",
                "value": 37
            }, {
                "date": "2016-09-15",
                "value": 42
            }, {
                "date": "2016-09-16",
                "value": 49
            }, {
                "date": "2016-09-17",
                "value": 46
            }, {
                "date": "2016-09-18",
                "value": 47
            }, {
                "date": "2016-09-19",
                "value": 55
            }, {
                "date": "2016-09-20",
                "value": 59
            }, {
                "date": "2016-09-21",
                "value": 58
            }, {
                "date": "2016-09-22",
                "value": 57
            }, {
                "date": "2016-09-23",
                "value": 61
            }, {
                "date": "2016-09-24",
                "value": 59
            }, {
                "date": "2016-09-25",
                "value": 67
            }, {
                "date": "2016-09-26",
                "value": 65
            }, {
                "date": "2016-09-27",
                "value": 61
            }, {
                "date": "2016-09-28",
                "value": 66
            }, {
                "date": "2016-09-29",
                "value": 69
            }, {
                "date": "2016-09-30",
                "value": 71
            }, {
                "date": "2016-10-01",
                "value": 67
            }, {
                "date": "2016-10-02",
                "value": 63
            }, {
                "date": "2016-10-03",
                "value": 46
            }, {
                "date": "2016-10-04",
                "value": 32
            }, {
                "date": "2016-10-05",
                "value": 21
            }, {
                "date": "2016-10-06",
                "value": 18
            }, {
                "date": "2016-10-07",
                "value": 21
            }, {
                "date": "2016-10-08",
                "value": 28
            }, {
                "date": "2016-10-09",
                "value": 27
            }, {
                "date": "2016-10-10",
                "value": 36
            }, {
                "date": "2016-10-11",
                "value": 33
            }, {
                "date": "2016-10-12",
                "value": 31
            }, {
                "date": "2016-10-13",
                "value": 30
            }, {
                "date": "2016-10-14",
                "value": 34
            }, {
                "date": "2016-10-15",
                "value": 38
            }, {
                "date": "2016-10-16",
                "value": 37
            }, {
                "date": "2016-10-17",
                "value": 44
            }, {
                "date": "2016-10-18",
                "value": 49
            }, {
                "date": "2016-10-19",
                "value": 53
            }, {
                "date": "2016-10-20",
                "value": 57
            }, {
                "date": "2016-10-21",
                "value": 60
            }, {
                "date": "2016-10-22",
                "value": 61
            }, {
                "date": "2016-10-23",
                "value": 69
            }, {
                "date": "2016-10-24",
                "value": 67
            }, {
                "date": "2016-10-25",
                "value": 72
            }, {
                "date": "2016-10-26",
                "value": 77
            }, {
                "date": "2016-10-27",
                "value": 75
            }, {
                "date": "2016-10-28",
                "value": 70
            }, {
                "date": "2016-10-29",
                "value": 72
            }, {
                "date": "2016-10-30",
                "value": 70
            }, {
                "date": "2016-10-31",
                "value": 72
            }, {
                "date": "2016-11-01",
                "value": 73
            }, {
                "date": "2016-11-02",
                "value": 67
            }, {
                "date": "2016-11-03",
                "value": 68
            }, {
                "date": "2016-11-04",
                "value": 65
            }, {
                "date": "2016-11-05",
                "value": 71
            }, {
                "date": "2016-11-06",
                "value": 75
            }, {
                "date": "2016-11-07",
                "value": 74
            }, {
                "date": "2016-11-08",
                "value": 71
            }, {
                "date": "2016-11-09",
                "value": 76
            }, {
                "date": "2016-11-10",
                "value": 77
            }, {
                "date": "2016-11-11",
                "value": 81
            }, {
                "date": "2016-11-12",
                "value": 83
            }, {
                "date": "2016-11-13",
                "value": 80
            }, {
                "date": "2016-11-14",
                "value": 81
            }, {
                "date": "2016-11-15",
                "value": 87
            }, {
                "date": "2016-11-16",
                "value": 82
            }, {
                "date": "2016-11-17",
                "value": 86
            }, {
                "date": "2016-11-18",
                "value": 80
            }, {
                "date": "2016-11-19",
                "value": 87
            }, {
                "date": "2016-11-20",
                "value": 83
            }, {
                "date": "2016-11-21",
                "value": 85
            }, {
                "date": "2016-11-22",
                "value": 84
            }, {
                "date": "2016-11-23",
                "value": 82
            }, {
                "date": "2016-11-24",
                "value": 73
            }, {
                "date": "2016-11-25",
                "value": 71
            }, {
                "date": "2016-11-26",
                "value": 75
            }, {
                "date": "2016-11-27",
                "value": 79
            }, {
                "date": "2016-11-28",
                "value": 70
            }, {
                "date": "2016-11-29",
                "value": 73
            }, {
                "date": "2016-11-30",
                "value": 61
            }, {
                "date": "2016-12-01",
                "value": 62
            }, {
                "date": "2016-12-02",
                "value": 66
            }, {
                "date": "2016-12-03",
                "value": 65
            }, {
                "date": "2016-12-04",
                "value": 73
            }, {
                "date": "2016-12-05",
                "value": 79
            }, {
                "date": "2016-12-06",
                "value": 78
            }, {
                "date": "2016-12-07",
                "value": 78
            }, {
                "date": "2016-12-08",
                "value": 78
            }, {
                "date": "2016-12-09",
                "value": 74
            }, {
                "date": "2016-12-10",
                "value": 73
            }, {
                "date": "2016-12-11",
                "value": 75
            }, {
                "date": "2016-12-12",
                "value": 70
            }, {
                "date": "2016-12-13",
                "value": 77
            }, {
                "date": "2016-12-14",
                "value": 67
            }, {
                "date": "2016-12-15",
                "value": 62
            }, {
                "date": "2016-12-16",
                "value": 64
            }, {
                "date": "2016-12-17",
                "value": 61
            }, {
                "date": "2016-12-18",
                "value": 59
            }, {
                "date": "2016-12-19",
                "value": 53
            }, {
                "date": "2016-12-20",
                "value": 54
            }, {
                "date": "2016-12-21",
                "value": 56
            }, {
                "date": "2016-12-22",
                "value": 59
            }, {
                "date": "2016-12-23",
                "value": 58
            }, {
                "date": "2016-12-24",
                "value": 55
            }, {
                "date": "2016-12-25",
                "value": 52
            }, {
                "date": "2016-12-26",
                "value": 54
            }, {
                "date": "2016-12-27",
                "value": 50
            }, {
                "date": "2016-12-28",
                "value": 50
            }, {
                "date": "2016-12-29",
                "value": 51
            }, {
                "date": "2016-12-30",
                "value": 52
            }, {
                "date": "2016-12-31",
                "value": 58
            }, {
                "date": "2017-01-01",
                "value": 60
            }, {
                "date": "2017-01-02",
                "value": 67
            }, {
                "date": "2017-01-03",
                "value": 64
            }, {
                "date": "2017-01-04",
                "value": 66
            }, {
                "date": "2017-01-05",
                "value": 60
            }, {
                "date": "2017-01-06",
                "value": 63
            }, {
                "date": "2017-01-07",
                "value": 61
            }, {
                "date": "2017-01-08",
                "value": 60
            }, {
                "date": "2017-01-09",
                "value": 65
            }, {
                "date": "2017-01-10",
                "value": 75
            }, {
                "date": "2017-01-11",
                "value": 77
            }, {
                "date": "2017-01-12",
                "value": 78
            }, {
                "date": "2017-01-13",
                "value": 70
            }, {
                "date": "2017-01-14",
                "value": 70
            }, {
                "date": "2017-01-15",
                "value": 73
            }, {
                "date": "2017-01-16",
                "value": 71
            }, {
                "date": "2017-01-17",
                "value": 74
            }, {
                "date": "2017-01-18",
                "value": 78
            }, {
                "date": "2017-01-19",
                "value": 85
            }, {
                "date": "2017-01-20",
                "value": 82
            }, {
                "date": "2017-01-21",
                "value": 83
            }, {
                "date": "2017-01-22",
                "value": 88
            }, {
                "date": "2017-01-23",
                "value": 85
            }, {
                "date": "2017-01-24",
                "value": 85
            }, {
                "date": "2017-01-25",
                "value": 80
            }, {
                "date": "2017-01-26",
                "value": 87
            }, {
                "date": "2017-01-27",
                "value": 84
            }, {
                "date": "2017-01-28",
                "value": 83
            }, {
                "date": "2017-01-29",
                "value": 84
            }, {
                "date": "2017-01-30",
                "value": 81
            }]
        });

        chart.addListener("rendered", zoomChart);

        zoomChart();

        function zoomChart() {
            chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
        }
    }

    /*if ($("#chartdiv2").length){
     var chart = AmCharts.makeChart( "chartdiv2", {
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
     }*/

    /*if ($("#chartdiv3").length){
     var chart = AmCharts.makeChart( "chartdiv3", {
     "type": "pie",
     "theme": "light",
     "dataProvider": [ {
     "country": "Lithuania",
     "litres": 501.9
     }, {
     "country": "Czech Republic",
     "litres": 301.9
     }, {
     "country": "Ireland",
     "litres": 201.1
     }, {
     "country": "Germany",
     "litres": 165.8
     }, {
     "country": "Australia",
     "litres": 139.9
     }, {
     "country": "Austria",
     "litres": 128.3
     }, {
     "country": "UK",
     "litres": 99
     }, {
     "country": "Belgium",
     "litres": 60
     }, {
     "country": "The Netherlands",
     "litres": 50
     } ],
     "valueField": "litres",
     "titleField": "country",
     "balloon":{
     "fixedPosition":true
     },
     "export": {
     "enabled": true
     }
     } );
     }*/

});