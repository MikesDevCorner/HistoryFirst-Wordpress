(function($) {

    $(document).ready(function() {

        "use strict";
        let sidebarIcon = $(".js-menu-item");
        let menu = $(".js-sidebar-menu");
        let micons = $(".js-icon-list");
        let content = $(".js-sidebar-menu-content");
	    let middleHeight = $(".home-topic").first().height();
        let padding = 30;
        let restScreen = $(window).height() - middleHeight;
	    let redRibbon = (3 * middleHeight) + restScreen; //$(".red-ribbon").first().height();
        $(".red-ribbon").css("height", redRibbon);

        if (window.matchMedia("(max-width: 575px)").matches) {
            padding = 15;
        }

        // Polyfill for CSS variables for IE
        cssVars();

        $('.js-navbar-toggler').on('click', function () {
            $('.js-animated-menu-icon').toggleClass('open');
        }); //TODO

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

        function sidebarMenu(elem, hover = false, leave = false) {
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
        $(".js-open-mobile-submenu").click(function(e) {
            let elem = $(this);
            if(!$(e.target).closest('.js-mobile-submenu').length) {
                if(elem.hasClass("open-submenu") || elem.hasClass("no-sub-items")) {
                    location.href = $(this).find('a:first').attr('href');
                }
                e.preventDefault();
                $(".open-submenu").removeClass("open-submenu");
                $(".js-mobile-submenu.open").removeClass("open").slideUp();
                elem.addClass("open-submenu");
                elem.parent().find($(".js-mobile-submenu")).addClass("open").slideDown();
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
        $(".js-slogan").each(function() {
            let elem = $(this);

            let max = parseInt(elem.data("max"));
            let i = 2;
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
                $(".js-slogan-rest").hide().fadeIn(1000);
                elem.hide().html(text).fadeIn(1000);
                if(i < max) {
                    i++;
                } else {
                    i = 1;
                }
                bar.set(0);
                bar.animate(1);
            }, 5000);
        });

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

        function changeImg(parent, i,next) {
            let img = parent;
            let imgAct = img.find("img[data-index='"+i+"']");
            let imgNext = img.find("img[data-index='"+next+"']");

            img.addClass("goaway");
            imgAct.css("opacity", "0");
            img.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                function(e) {
                    img.removeClass("goaway");
                    img.addClass("start");
            });

            setTimeout(function(){
                imgNext.css("opacity", "1");
                img.removeClass("start");
            }, 600);
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

        // Parallax effect for homepage
        $('.js-parallax').mousemove(function (e) {
            parallax(e, this, 1);
        }).mouseleave(function (e) {
            $(this).css({'top': '50%' ,'left' : '50%'});
        });

        function parallax(e, target, layer) {
            var layer_coeff = 10 / layer;
            var x = ($(window).width() - target.offsetWidth) / 2 - (e.pageX - ($(window).width() / 2)) / layer_coeff;
            var y = ($(window).height() - target.offsetHeight) / 2 - (e.pageY - ($(window).height() / 2)) / layer_coeff;
            $(target).offset({ top: y ,left : x });
        }

        $('.js-img-parallax').each(function(){
            var $bgobj = $(this);

            $(window).scroll(function() {
                var yPos = -($(window).scrollTop() / 2);
                var coords = '50% '+ yPos + 'px';

                $bgobj.css({ backgroundPosition: coords });
            });
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

            map = L.map($el[0], {
                minZoom : 0,
                maxZoom : 18,
                zoomSnap : 0.1,
                zoomDelta: 0.5,
                scrollWheelZoom	: false,
                touchZoom:true,
                dragging:!L.Browser.mobile
            });

            L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
                attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>'})
                .addTo(map);

            /*var baseLayers = {
            "Mapbox": mapbox,
            "OpenStreetMap": osm
        };
        L.control.layers(baseLayers).addTo(map);
        */

            map.markers= [];

            $.each($markers, function (index, value) {
                add_marker( jQuery(this), map);
            });

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

            var marker_content = '<div class="map-property clearfix">'+
                '<p>'+$marker.find('.js-info').html()+'</p>'+
                '</div>';

            var marker = L.marker([$marker.attr('data-lat'), $marker.attr('data-lng')],
                {icon: firstIcon}).addTo(map).bindPopup(marker_content);
            latlngs.push([$marker.attr('data-lat'), $marker.attr('data-lng')]);


            /* var marker =  L.circleMarker([$marker.attr('data-lat'), $marker.attr('data-lng')], {
                radius:10,
                fillColor: $marker[0].color,
                color: "#000",
                weight: 2,
                opacity: 1,
                fillOpacity: 1,
            }).addTo(map).bindPopup(marker_content);*/

            //.bindTooltip("1", {permanent: true, className: "my-label", offset: [0, 0], direction: 'center' })

            map.markers.push( marker );
        }


        function center_map( map ) {
            if ( map.markers.length == 1 ) {
                map.setView(map.markers[0].getLatLng(),15);
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