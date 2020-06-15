<nav class=" navbar navbar-expand-lg navbar-light bg-light nav-custom ">
    <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{asset('assets/img/gtore.png')}}" class="navbar-img" height="25px">
    </a>
    <span class=" search-icon-toggle" ><i class="fa fa-search"></i> </span>
    <form  class="search-bar" action="#" >
        <input class="search-input form-control" type="text" placeholder="Search">
        <div class="btn-group">
            <button type="button" class="btn  dropdown-toggle drop-nav" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                All Category
            </button>
            <div class="dropdown-menu" >
                <a class="dropdown-item drop-nav-item"  href="#">Action</a>
                <a class="dropdown-item drop-nav-item"  href="#">Another action</a>
                <a class="dropdown-item drop-nav-item"  href="#">Something else here</a>

            </div>
        </div>
        <button type="submit" class="search-icon"><i class="fa fa-search"></i></button>
    </form>
    @auth
        <a href="{{route('order')}}" class="d-flex flex-row cart-custom" style="margin-top: -15px">
            <div class="cart-text">
                <img src="{{asset('assets/img/shopping-cart%20(2).png')}}" height="32px" width="32px" class="cart-img" alt="logo">
            </div>
        </a>
        <a href="{{route('cart')}}" class="d-flex flex-row cart-custom" >
            <div class="cart-text">
                <div class="cart-num-div"> <div class="cart-num">{{auth('web')->user()->cart()->count()}}</div></div>
                <div class="cart-word">cart</div>
            </div>
        </a>
        <div class="avatar">
            <img src="{{asset('images/users/'.auth('web')->user()->image)}}" width="28px" height="28px" class="nav-avatar" alt="avatar">
            <div class="login"><a href="#">{{auth('web')->user()->name}}</a></div>
            <div class="avatar-split">|</div>
        </div>
    @endauth
    @guest

        <div class="avatar">
            <img src="{{asset('assets/img/user.png')}}" width="28px" height="28px" class="nav-avatar" alt="avatar">
            <div class="login"><a href="{{route('login')}}">Login</a></div>
            <div class="avatar-split">|</div>
            <div class="register register-selection"><a href="{{route('register')}}">Register</a></div>
        </div>
    @endguest

    <div class="ml-auto language">English </div>
    @auth
        <div class="ml-auto language">
            <a href="{{route('logout')}}" class="btn btn-danger text-white">Logout</a>
        </div>
    @endauth
</nav>
