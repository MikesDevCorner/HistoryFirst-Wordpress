(function($) {

    $(document).ready(function() {

        "use strict";

        // Polyfill for CSS variables for IE
        cssVars();

        $('.js-navbar-toggler').on('click', function () {
            $('.js-animated-menu-icon').toggleClass('open');
        }); //TODO

        $(".js-menu-item").click(function(e) {
            e.preventDefault();

        });

        $(".js-redirect").click(function(e) {
            e.preventDefault();
            location.href = $(this).find('a:first').attr('href');
        });

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
                elem.hide().text(text).fadeIn(1000);
                if(i < max) {
                    i++;
                } else {
                    i = 1;
                }
                changeImg($(".js-home-topic--left"), act, next);
                changeImg($(".js-home-topic--right"), act, next);
                bar.set(0);
                bar.animate(1);
            }, 5000);
        });

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


/*

            let imgLeft = $(".js-home-topic--left:not(.next)");
            let imgLeft__img = imgLeft.find("img");
            let next = imgLeft.data("img"+i);

            //let imgRight = $(".js-home-topic--right:not(.next)");
            let nextLeft = $(".js-home-topic--left.next");
            //let nextRight = $(".js-home-topic--right.next");


            imgLeft.addClass("goaway");
            setTimeout(function () {
                imgLeft.removeClass("goaway");
                imgLeft.addClass("start");
                setTimeout(function () {
                    imgLeft__img.hide().attr("src", next).show();
                    imgLeft.removeClass("start");
                }, 300);

            }, 500);
            //imgRight.css("transform", "translateY(-100vh)");
            //nextLeft.fadeIn().removeClass("next").css("transform", "translateY(0)");
            //imgLeft.addClass("next").css("transform", "translateY(-100vh)").find("img").attr("src", next);
*/        }



    });
})( jQuery );