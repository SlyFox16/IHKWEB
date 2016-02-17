(function ($) {
    "use strict";

    var fn = {

        // Launch Functions
        Launch: function () {
            fn.Wow();
            fn.Stellar();
            fn.StickyFooter();
            fn.Tooltip();
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

        Tooltip: function() {
            $(document).ready(function() {
            // Tooltip only Text
            $('.user-area a').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
            }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
            }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
            });
            });
        },

        // Apps
        Apps: function () {
            $('select').fancySelect();
        }


    };

    $(document).ready(function () {
        fn.Launch();
    });

})(jQuery);