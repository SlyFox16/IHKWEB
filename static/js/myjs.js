$(document).ready(function(){
    $(".rating i").on('mouseover',function(e){
        var index = $(this).index() + 1;
        $(".rating i").addClass('fa-star-o').removeClass('fa-star');
        for(n=1; n<=index; n++) {
            $(".rating i:nth-child("+n+")").toggleClass('fa-star-o fa-star');
        }
    });

    $(".rating").on('mouseleave',function(e){
        $(".rating i").addClass('fa-star-o').removeClass('fa-star');
    });

    $('.rating i').on('click',function(){
        var index = $(this).index() + 1;
        var r = confirm('Really want to vote?');
        for(n=1; n<=index; n++) {
            $(".rating i:nth-child("+n+")").toggleClass('fa-star-o fa-star');
        }
        if (r == true) {
            $.post(
                "/user/rating",
                {username: username, index: index},
                function(data){
                    $(".userRating").find("b").html(data);
                    $(".rating i").unbind();
                    $(".rating").unbind();
                }
            )
        }
    });

    $(".addButton").on('click', function () {
        var count = $('div[class^=field-row]', $(this).closest('form')).length;

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

    $('#xing-login').on('click', function(){
        $('#xingpass').modal('hide');
        return true;
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
});