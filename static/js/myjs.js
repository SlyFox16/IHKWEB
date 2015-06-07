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
        var r = confirm(index);
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
});