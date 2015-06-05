(function ($) {
    "use strict";

    var fn = {

        // Launch Functions
        Launch: function () {
            fn.Wow();
            fn.Stellar();
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

        // Apps
        Apps: function () {
            // Fancy Select
            $('select').fancySelect();
        }


    };

    $(document).ready(function () {
        fn.Launch();
    });

})(jQuery);