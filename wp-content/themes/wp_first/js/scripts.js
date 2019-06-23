(function($) {

    $(document).ready(function() {

        "use strict";

        // Polyfill for CSS variables for IE
        cssVars();

        $('.js-navbar-toggler').on('click', function () {
            $('.js-animated-menu-icon').toggleClass('open');
        }); //TODO

        // open (desktop) menu
        $(".js-menu-item").click(function(e) {
            e.preventDefault();
            let elem = $(this);
            let actualElemPost = elem.data("post");
            let menu = $(".js-sidebar-menu");
            let icons = $(".js-icon-list");
            let content = $(".js-sidebar-menu-content");
            let newContent = $(".js-sidebar-menu-content[data-post='"+actualElemPost+"']");

            if(!newContent.hasClass("show")) {
                menu.addClass("open");
                icons.find(".active").removeClass("active");
                elem.addClass("active");
                content.removeClass("show");
                newContent.addClass("show");
            } else {
                icons.find(".active").removeClass("active");
                newContent.removeClass("show");
                menu.removeClass("open");
            }
        });

        // click outside the (desktop) menu to close it
        let menu = $(".js-sidebar-menu");
        let icons = $(".js-icon-list");
        $(document).mouseup(function (e) {
            if (!menu.is(e.target) // if the click target isn't the menu
                && menu.has(e.target).length === 0) { // ... nor a descendant of it
                menu.removeClass('open');
                icons.find(".active").removeClass("active");
            }
        });

        // remove visible sidebar menu on desktop
        $( window ).resize(function() {
            if (window.matchMedia("(max-width: 991px)").matches) {
                menu.removeClass("open");
            }
        });


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
                moveRibbon(act*100 + act);
                if(act === 0) {
                    act = max;
                }
                let next = i;
                $(".js-slogan-rest").hide().fadeIn(1000);
                elem.hide().text(text).fadeIn(1000);
                if(i < max) {
                    i++;
                } else {
                    i = 1;
                }
                //changeImg($(".js-home-topic--left"), act, next);
                //changeImg($(".js-home-topic--right"), act, next);
                bar.set(0);
                bar.animate(1);
            }, 5000);
        });

        // helper function for moving ribbon
        function moveRibbon(offset) {
           let ribbon = $(".js-ribbon");
           ribbon.each(function() {
               let elem = $(this);
               if(elem.hasClass("red-ribbon--right")) {
                   let size = 21 - parseFloat(offset);
                   elem.css("transform", "translateY("+size+"vh)");
               } else {
                   let size = -181 + parseFloat(offset);
                   elem.css("transform", "translateY("+size+"vh)");
               }
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



    });
})( jQuery );