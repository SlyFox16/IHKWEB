$(document).ready(function(){
    $(".addButton").on('click', function () {
        var count = $('ul[class*=addfield]', $(this).closest('form')).length;

        var self = $(this);
        $.ajax({
            url: '/user/additem',
            dataType: 'json',
            type: 'GET',
            data: {count: count},
            success: function (data) {
                $('.wheretoadd', self.closest('form')).append(data.responce);
            }
        });
        return false;
    });

    $("#cabinet-form").on('click', '.removeButton', function () {
        var self = $(this);
        var attr = $('.fields', '.wheretoadd').last().attr('data-id');
        if(attr != 'undefined' && $.isNumeric(attr)) {
            $.ajax({
                url: '/user/deleteitem',
                dataType: 'json',
                type: 'GET',
                data: {attr: attr},
                success: function (data) {
                    if(data)
                        $('.fields', '.wheretoadd').last().remove();
                }
            });
        } else {
            $('.fields', '.wheretoadd').last().remove();
        }

        return false;
    });


    // This function is called by the plugin after
    // the login flow is completed.
    function onXingAuthLogin(response) {
        var output;

        console.log(response);

        if (response.user) {
            output = 'Successful login for ' + response.user.display_name;
        } else if (response.error) {
            output = 'Error: ' + response.error;
        }

        console.log(output);
    }

    $('#cabinet-form a').on('click', function(){
        $(this).find("i").toggleClass('fa-spin');
    });

    function _actAttach(val) {
        alert(val);
    }
});