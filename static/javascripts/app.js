(function ($) {
    "use strict";

    var fn = {


        

        // Launch Functions
        Launch: function () {
            fn.Parallax();
            fn.Wow();
            fn.StickyFooter();
            fn.Apps();
        },


        // Parallax
        Parallax: function() {
            if(!(navigator.userAgent.match(/iPhone|iPad|iPod|Android|BlackBerry|IEMobile/i))) {
                $.stellar({
                    horizontalScrolling: false,
                    positionProperty: 'transform',
                    hideDistantElements: false
                });
            }
        },

        // Wow
        Wow: function() {
            var wow = new WOW(
                {
                    boxClass: 'wow',
                    offset: 0,
                    mobile: false
                }
            );
            wow.init();
        },


        // Sticky Footer
        StickyFooter: function () {
            var footerHeight, 
                footer = $('footer'),
                element = $('body');

            function centerImage() {
                footerHeight = footer.innerHeight();
                element.css({'padding-bottom' : footerHeight});
            }
            $(window).on("load resize", centerImage);
        },


        // Apps
        Apps: function () {
            // Foundation
            $(document).foundation();
        }


    };

    $(document).ready(function () {
        fn.Launch();
    });

})(jQuery);