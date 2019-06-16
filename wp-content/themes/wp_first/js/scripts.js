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
                elem.hide().text(text).fadeIn("slow");
                if(i < max) {
                    i++;
                } else {
                    i = 1;
                }
                bar.set(0);
                bar.animate(1);
            }, 5000);
        });



    });
})( jQuery );