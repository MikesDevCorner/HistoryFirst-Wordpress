(function($) {

    $(document).ready(function() {

        "use strict";
        let sidebarIcon = $(".js-menu-item");
        let menu = $(".js-sidebar-menu");
        let micons = $(".js-icon-list");
        let content = $(".js-sidebar-menu-content");
	    let loadScreen = $(".js-home-loading");
	    let touchInfo = $(".js-show-touchinfo");
        let padding = 30;
        let showHomeCircleAgain = false;
        let middleHeight, restScreen, redRibbon;

        // Polyfill for CSS variables for IE
        cssVars();

        let pageTitle = $("title");
        let orgTitle = pageTitle.text();
        let windowFocus = true;

        $(window).focus(function() {
            windowFocus = true;
            pageTitle.text(orgTitle);

            if(showHomeCircleAgain) {
                showHomeCircleAgain = false;
                $(".js-slogan").show().addClass("in").removeClass("out");
            }
        }).blur(function() {
            windowFocus = false;
            changeTitle();
        });

        function changeTitle() {
            setTimeout(function () {
                if(!windowFocus) {
                    pageTitle.text("Geschichte wartet ... – history.first");
                    setTimeout(function () {
                        if(!windowFocus) {
                            pageTitle.text(orgTitle);
                            changeTitle();
                        }
                    }, 3000);
                }
            }, 3000);
        }

        // calc vh dynamically (iOS fix)
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', vh+'px');

        $(window).load(function() {
            middleHeight = $(".home-topic").first().height();
            restScreen = $(window).height() - middleHeight;
            redRibbon = (3 * middleHeight) + restScreen; //$(".red-ribbon").first().height();
            $(".red-ribbon").css("height", redRibbon);
        });

        if (window.matchMedia("(max-width: 575px)").matches) {
            padding = 15;
        }

        // show load screen at first page load
        if(loadScreen.length) {
            if(sessionStorage.getItem('loaded')) {
              loadScreen.hide();
              startCircles();
              touchInfo.addClass("active");
            } else {
                var start = false;
                $(window).load(function () {
                    start = true;
                    sessionStorage.setItem('loaded', 'true');
                    touchInfo.addClass("active");
                });

                $(".js-slogan").each(function() {
                    let elem = $(this);
                    let text = "Geschichte<br>laden";
                    elem.hide().html(text).fadeIn(1000);

                    var bar = new ProgressBar.Circle(".js-progress-circle", {
                        strokeWidth: 1,
                        duration: 2000,
                        color: '#FFF',
                        trailColor: '#eee',
                        trailWidth: 0.4,
                        svgStyle: null
                    });

                    bar.animate(1);
                    isLoaded();

                    function isLoaded() {
                        setTimeout(function() {
                            bar.set(0);
                            if(start) {
                                bar.destroy();
                                loadScreen.fadeOut("slow");
                                startCircles();
                            } else {
                                bar.animate(1);
                                isLoaded();
                            }
                        }, 2000)
                    }

                });
            }
        }

        $('.js-navbar-toggler').on('click', function () {
            $('.js-animated-menu-icon').toggleClass('open');
        });

        // open (desktop) menu
        sidebarIcon.mouseenter(function(e) {
            let elem = $(this);
            if(!elem.hasClass("active")) {
                sidebarMenu(elem, true);
            }
        });
        $(document).on("mouseleave", ".js-sidebar-menu", function(e) {
            let elem = $(this);
            micons.find(".active").removeClass("active");
            content.removeClass("show");
            elem.removeClass("open");
        });

        // fix scrolling
        $(".js-menu-item").click(function(e) {
           e.preventDefault();
        });

        //function sidebarMenu(elem, hover = false, leave = false) {
        function sidebarMenu(elem, hover, leave) {
            hover = hover || false; //IE fix
            leave = leave || false; //IE fix
            let actualElemPost = elem.data("post");
            let newContent = $(".js-sidebar-menu-content[data-post='"+actualElemPost+"']");

            if(!newContent.hasClass("show")) {
                if (!leave) {
                    menu.addClass("open");
                    micons.find(".active").removeClass("active");
                    elem.addClass("active");
                    content.removeClass("show");
                    newContent.addClass("show");
                }
            } else {
                if (!hover) {
                    micons.find(".active").removeClass("active");
                    newContent.removeClass("show");
                    menu.removeClass("open");
                }
            }
        }

        // mobile menu
        $(".js-arrow-btn").click(function() {
            let elem = $(this);
            let parent = elem.parent();
            if(parent.hasClass("open-submenu")) {
                parent.removeClass("open-submenu");
                parent.find(".js-mobile-submenu").removeClass("open").slideUp();
            } else {
                $(".open-submenu").removeClass("open-submenu");
                $(".js-mobile-submenu.open").removeClass("open").slideUp();
                parent.addClass("open-submenu");
                parent.find(".js-mobile-submenu").addClass("open").slideDown();
            }

        });

        // remove visible sidebar menu on desktop
        $( window ).resize(function() {
            if (window.matchMedia("(max-width: 991px)").matches) {
                menu.removeClass("open");
            }
            if (window.matchMedia("(max-width: 575px)").matches) {
                padding = 15;
            } else {
                padding = 30;
            }

	        middleHeight = $(".home-topic").first().height();
	        redRibbon = $(".red-ribbon").first().height();
            $(".red-ribbon").css("height", redRibbon);
        });

        checkOffset();
        $(document).scroll(function() {
            checkOffset();
        });

        function checkOffset() {
            let aside = $(".js-aside");
            if(aside.length) {
                if(aside.offset().top + aside.height() >= aside.offset().top - 10) {
                    aside.addClass("fixed");
                }
                if($(document).scrollTop() + window.innerHeight < $('.js-footer').offset().top) {
                    aside.removeClass("fixed");
                }
            }
        }


        // make link areas clickable
        $(".js-redirect").click(function(e) {
            e.preventDefault();
            location.href = $(this).find('a:first').attr('href');
        });

        // change slogan on homepage, add progress circle and move ribbon
        function startCircles() {
            $(".js-slogan").each(function() {
                let elem = $(this);
                let max = parseInt(elem.data("max"));
                let i = 2;

                if(sessionStorage.getItem('loaded')) {
                    let text = elem.data("word1");
                    elem.hide().html(text).fadeIn(1000);
                    setTimeout(function() {
                        elem.addClass("out");
                    }, 4500);
                }

                var bar = new ProgressBar.Circle(".js-progress-circle", {
                    strokeWidth: 1,
                    duration: 5000,
                    color: '#FFF',
                    trailColor: '#eee',
                    trailWidth: 0.4,
                    svgStyle: null
                });

                bar.animate(1);

                setInterval(function () {
                    let text = elem.data("word"+i);
                    let act = i-1;
                    if(act === 0) {
                        act = max;
                    }
                    let next = i;
                    if(next === 1) {
                        moveRibbon(0);
                    }
                    if(next === 2) {
                        moveRibbon((redRibbon / 2) - (middleHeight / 2) + padding);
                    }
                    if(next === 3) {
                        moveRibbon(redRibbon - middleHeight + (padding * 2));
                    }
                    elem.hide().html(text).show().addClass("in").removeClass("out");
                    if(windowFocus) {
                        setTimeout(function () {
                            elem.removeClass("in").addClass("out");
                        }, 4500);
                    } else {
                        elem.hide().removeClass("in").addClass("out");
                        showHomeCircleAgain = true;
                    }
                    if(i < max) {
                        i++;
                    } else {
                        i = 1;
                    }
                    bar.set(0);
                    bar.animate(1);
                }, 5000);
            });
        }


        // helper function for moving ribbon
        function moveRibbon(offset) {
           let ribbon = $(".js-ribbon");
           ribbon.each(function() {
               let elem = $(this);
               let size = parseFloat(offset);
               if(elem.hasClass("red-ribbon--right")) {
                   size = -1 * parseFloat(offset);
               }
               elem.css("transform", "translateY("+size+"px)");
           });
        }

        $('.js-inline-svg').each(function(){
            let $img = $(this);
            let imgID = $img.attr('id');
            let imgClass = $img.attr('class');
            let imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                let $svg = $(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }

                // Replace image with new SVG
                $img.replaceWith($svg);
            }, 'xml');
        });

        if (window.matchMedia("(min-width: 767px)").matches) {
            $('.js-parallax').mouseenter(function() {
                var circle = $(this).parent().find(".js-progress-circle");

                if(!circle.hasClass("rotate")) {
                    circle.addClass("rotate");
                    resetCircleRotation(circle);
                }
            });
        }

        function resetCircleRotation(elem) {
            setTimeout(function() {
                elem.removeClass("rotate");
            }, 2000);
        }

        // image parallax effect
        $('.js-img-parallax').each(function(){
            var imgParent = $(this);

            function parallaxImg() {
                if (imgParent.offset().top < $(window).scrollTop()) { // if img is in visible area
                    // Get ammount of pixels the image is above the top of the window
                    var difference = $(window).scrollTop() - imgParent.offset().top;
                    // Top value of image is set to half the amount scrolled
                    var half = (difference / 2) + 'px';
                    imgParent.find('img').css('top', half);
                } else {
                    imgParent.find('img').css('top', '0');
                }
            }

            $(window).scroll(function() {
                parallaxImg();
            })
        });

        // Contact form - file upload check
        document.addEventListener( 'wpcf7submit', function( event ) {
            $("html, body").animate({
                scrollTop: $('.wpcf7-form').offset().top
            }, 1000);
        }, false );

        $('.js-file').change(function() {
            let fileName = $(this)[0].files[0].name;
            let fileLabel = $(".js-file-label");
            let limitInfo = $(".js-upload-limit");
            if($(this)[0].files[0].size >= 8000000) {
                limitInfo.addClass("upload");
                fileLabel.text("Datei ist zu groß").addClass("upload");
            } else {
                limitInfo.removeClass("upload");
                //fileLabel.text(fileName).addClass("upload");
            }
        });



        // Map ===========================================================
        var map = null;
        var latlngs = []; //array list of all points

        function render_map( $el ) {
            var $markers = $el.find('.js-marker');
            //var $legend = $el.find('.js-legend');

            map = L.map($el[0], {
                minZoom : 0,
                maxZoom : 18,
                zoomSnap : 0.1,
                zoomDelta: 0.5,
                scrollWheelZoom	: false,
                touchZoom:true,
                dragging:!L.Browser.mobile,
                fullscreenControl: {
                    pseudoFullscreen: false // if true, fullscreen to page width and height
                }
            });

            L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
                attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>'})
                .addTo(map);

            map.markers= [];

            $.each($markers, function (index, value) {
                add_marker( jQuery(this), map);
            });

            //create_legend($legend, map);

            map.setView([0, 0], 4);

            if($el.data("lines")) {
                var polyline = L.polyline(latlngs, {color: '#AF3802'}).addTo(map);
                //map.fitBounds(polyline.getBounds());
            }

            center_map( map );

            map.on('resize', function () {
                center_map( map );
            });

            $markers.remove();
        }

        function add_marker( $marker, map) {

            var firstIcon = L.icon({
                iconUrl: '/wp-content/themes/wp_first/img/marker-'+$marker.attr('data-color')+'.svg',
                iconSize:     [32, 32], // size of the icon
                iconAnchor:   [17, 31], // point of the icon which will correspond to marker's location
                popupAnchor:  [0, -17] // point from which the popup should open relative to the iconAnchor
            });

            var marker = L.marker([$marker.attr('data-lat'), $marker.attr('data-lng')],
                {icon: firstIcon}).addTo(map);

            if($.trim($marker.find('.js-info').html())) { // is not empty?
                var marker_content = '<div class="map-property clearfix">'+
                    '<p>'+$marker.find('.js-info').html()+'</p>'+
                    '</div>';

                marker.bindPopup(marker_content);
            }
            latlngs.push([$marker.attr('data-lat'), $marker.attr('data-lng')]);


            map.markers.push( marker );
        }

        function create_legend($legend, map) {
            var legend = L.control({position: 'bottomright'});

            legend.onAdd = function (map) {

                var div = L.DomUtil.create('div', 'info legend js-show-legend');

                $.each($legend, function (index, value) {
                    var elem = jQuery(this);
                    div.innerHTML +=
                        "<img src='/wp-content/themes/wp_first/img/marker-"+elem.attr('data-color')+".svg'>" +
                        elem.html() + "<br>";
                });

                return div;
            };

            legend.addTo(map);
        }


        function center_map( map ) {
            if ( map.markers.length == 1 ) {
                map.setView(map.markers[0].getLatLng(),12);
                // map.setZoom( 16 );
            }
            else {
                var group = new L.featureGroup(map.markers);
                map.fitBounds(group.getBounds().pad(0.2));
            }
        }

        $('.js-map').each(function(){
            render_map( $(this) );
        });

    });
})( jQuery );