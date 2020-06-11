<script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
@stack('scripts')
<script>
    $(".search-icon-toggle").click(function () {

        $(".search-bar").css({"display":"flex","flex-direction":"row"});
        $(".cart-custom").css({"visibility":"hidden"});
        $(".cart-img").css({"height":"30px","width":'30px'});
        $(".cart-num").css({"font-size":"0.9em"});
        $(".cart-word").css({"font-size":"0.9em"});
        $(".cart-text").css({"top":"0"});
        $(this).fadeOut()
    });
    $(".navbar-img").click(function () {
        $(".search-bar").fadeOut();
        $(".cart-custom").css({"visibility":""});
        $(".search-icon-toggle").fadeIn();
    });
    $(".navigation-button").click(function () {
        $(".category-main").toggle();
    })
</script>
<script  src="{{asset('assets/js/all.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" ></script>


