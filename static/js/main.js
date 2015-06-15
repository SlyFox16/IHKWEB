(function ($) {
    "use strict";

    var fn = {

        // Launch Functions
        Launch: function () {
            fn.Wow();
            fn.Stellar();
            fn.StickyFooter();
            fn.Apps();
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


        // Stellar
        Stellar: function() {
            if(!(navigator.userAgent.match(/iPhone|iPad|iPod|Android|BlackBerry|IEMobile/i))) {
                $.stellar({
                    horizontalScrolling: false,
                    positionProperty: 'transform',
                    hideDistantElements: false

                });
            }
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
        }


    };

    $(document).ready(function () {
        fn.Launch();
    });

})(jQuery);