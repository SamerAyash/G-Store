@extends('layouts.master_layout')

@push('style')
    <link href="{{asset('assets/css/index.css')}}" type="text/css" rel="stylesheet">
    <title>GStore</title>
@endpush
@section('content')
    <div class="row">
        <div class="navigation" style="display: flex ;flex-direction: column">
        <span class="navigation-button" >
            <i class="fa fa-bars"></i>
        </span>

            <div class="category-main">
                <div class="login-and-register">
                    <div class="login-register">
                        @guest
                            <a href="{{route('login')}}">
                                <div class="login-mob" style=""><i class="fas fa-user icon-loign"></i>
                                    <span class="login-word-mob">Sign in</span></div>
                            </a>
                            <a href="{{route('register')}}">
                                <div class="register-mob" style=""><i class="fas fa-user-plus icon-register">

                                    </i> <span class="register-word-mob">Sign up</span></div>
                            </a>
                        @endguest
                        @auth
                                <a href="#">
                                    <div class="login-mob" style=""><img width="28px" height="28px" class="nav-avatar" src="{{asset('images/users/'.auth()->user()->image)}}"/>
                                        <span class="login-word-mob">{{auth()->user()->name}}</span></div>
                                </a>
                                    <a href="{{route('logout')}}"
                                        class="btn btn-danger text-white"
                                        style="width: 90px;height: 30px; text-align: center;font-weight: 500">
                                        Logout
                                    </a>
                        @endauth
                    </div>
                </div>
                <div class="category-title">
                    <img src="{{asset('assets/img/list.png')}}" height="21px" width="21px" class="img-category">
                    <div class="category-word">Categories</div>
                </div>
                <div class="sub-category-main">

                    @foreach($categories as $category)
                        <div class="sub-category-out">
                            <div class="sub-category-in">
                                <img src="{{asset('assets/img/shop.png')}}" width="16px" height="16px" class="img-sub-category">
                                <span class="sub-category-word">{{$category->name}}</span>
                            </div>
                            <div>
                                <hr class="line-sub-category">
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <span class="sliders col-md-9" >

        <span class="main-slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators indicator-custom" >
    @for($i=0;$i < count($favoritePros);$i++)
            <li data-target="#carouselExampleIndicators" @if($i == 0)
            class="active"@endif data-slide-to="{{$i}}"></li>
        @endfor
    </ol>
  <div class="carousel-inner">
      @php
          $favoritePro=$favoritePros->first();
            $favoritePros->shift();
      @endphp
          <div class="carousel-item active">
              <a href="{{route('product',$favoritePro->id)}}">
                 <img class="d-block w-100 img-slider" src="{{asset('images/products/'.$favoritePro->mainImage)}}" alt="{{$favoritePro->title}}">
              </a>
          </div>
      @foreach($favoritePros as $product)
            <div class="carousel-item ">
                <a href="{{route('product',$product->id)}}">
            <img class="d-block w-100 img-slider" src="{{asset('images/products/'.$product->mainImage)}}" alt="{{$product->title}}">
                </a>
            </div>
      @endforeach

  </div>
  <a class="carousel-control-prev prev-custom" href="#carouselExampleIndicators"    role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next next-custom" href="#carouselExampleIndicators"   role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
            </div>
</span>
            <div class="recommednd-word">Recommended For You</div>
        <!-- product slider -->
<div class="row product-slider-main">
    <div class="col-md-12">
        <div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
         <div class="carousel-item active">
        <div class="row">

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
           <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

              <div class="col-md-2 col-2 first-slider-item product-inside">
                  <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
              <div class="green-card"><div class="green-card-in">34% OFF</div></div>

              </div>

             <div class="col-md-2 col-2 first-slider-item product-inside">
                 <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
             <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>
        </div>

    </div>
         <div class="carousel-item ">
       <div class="row" >
             <div class="col-md-2 col-2 first-slider-item product-inside">
                 <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
           <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

              <div class="col-md-2 col-2 first-slider-item product-inside">
                  <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
              <div class="green-card"><div class="green-card-in">34% OFF</div></div>

              </div>

             <div class="col-md-2 col-2 first-slider-item product-inside">
                 <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
             <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>
       </div>
    </div>
         <div class="carousel-item ">
         <div class="row" >
             <div class="col-md-2 col-2 first-slider-item product-inside">
                 <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
           <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

              <div class="col-md-2 col-2 first-slider-item product-inside">
                  <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
              <div class="green-card"><div class="green-card-in">34% OFF</div></div>

              </div>

             <div class="col-md-2 col-2 first-slider-item product-inside">
                 <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
            <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>

            <div class="col-md-2 col-2 first-slider-item product-inside">
                <img class="d-block w-100 product-img-slider" src="{{asset('assets/img/fourth.jpg')}}"  alt="First slide">
           <div class="product-name">Apple iphone 11 Pro Max with faceTime Black</div>
               <div class="product-price"><div class="nis">NIS</div><div class="price-num">120</div><del class="price-del">NIS 140</del></div>
             <div class="green-card"><div class="green-card-in">34% OFF</div></div>
           </div>
         </div>

    </div>

  </div>
  <a class="carousel-control-prev prev-control-product" href="#carouselExampleControls"  role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next next-control-product" href="#carouselExampleControls"  role="button" data-slide="next">
    <span class="carousel-control-next-icon"  aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    </div>

</div>
</span>
    <div class="advertisment"><span style="">Advertisment</span></div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Best Sales</p>

        <div class="best-sales  row " >
            @foreach($bestSales as $product)
            <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                <a href="{{route('product',$product->id)}}">
                <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                <div class="product-name">{{$product->title}}</div>
                @if($product->offer)
                    <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                        {{$product->price}}</del></div>
                    <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                @else
                    <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                @endif
                </a>
            </div>
                @endforeach
        </div>
        <div class="view-more-out">
               <div class="view-more-div">
                   <a href="#">
                       <span class="view-more-in" style="">view more</span>
                   </a>
               </div>
        </div>

    <div class="offers-out"><img src="{{asset('assets/img/tag%20(1).png')}}" class="img-offers" width="45px" height="45px">
        <div class="offers-word-background"><span class="offers-word">OFFERS FOR 24 ONNLY</span>
        </div>
    </div>

    <div class="row offers-content">
        @foreach($offers as $offer)
            @php
            $product =$offer->product;
            @endphp
            <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                <a href="{{route('product',$product->id)}}">
                <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                <div class="product-name">{{$product->title}}</div>
                    <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                            {{$product->price}}</del></div>
                    <div class="green-card"><div class="green-card-in">{{$offer->discount}}% OFF</div></div>
                </a>
            </div>
        @endforeach
    </div>
        <div class="product-with-viewmore ">
            <p class="best-sales-word">Food Market</p>

            <div class="best-sales  row " >
                @foreach($foodMarket as $product)
                    <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                        <a href="{{route('product',$product->id)}}">
                        <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                        <div class="product-name">{{$product->title}}</div>
                        @if($product->offer)
                            <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                    {{$product->price}}</del></div>
                            <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                        @else
                            <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                        @endif
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="view-more-out">
                <div class="view-more-div">
                    <a href="#">
                        <span class="view-more-in" style="">view more</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Mobiles & Tablets</p>

        <div class="best-sales  row " >
            @foreach($mobiles as $product)
                <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                    <a href="{{route('product',$product->id)}}">
                    <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                    <div class="product-name">{{$product->title}}</div>
                    @if($product->offer)
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                {{$product->price}}</del></div>
                        <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                    @else
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="view-more-out">
            <div class="view-more-div">
                <a href="#">
                    <span class="view-more-in" style="">view more</span>
                </a>
            </div>
        </div>
    </div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Electronics</p>

        <div class="best-sales  row " >
            @foreach($electronics as $product)
                <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                    <a href="{{route('product',$product->id)}}">
                    <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                    <div class="product-name">{{$product->title}}</div>
                    @if($product->offer)
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                {{$product->price}}</del></div>
                        <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                    @else
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="view-more-out">
            <div class="view-more-div">
                <a href="#">
                    <span class="view-more-in" style="">view more</span>
                </a>
            </div>
        </div>
    </div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Beauty & Health</p>

        <div class="best-sales  row " >
            @foreach($beauty as $product)
                <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                    <a href="{{route('product',$product->id)}}">
                    <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                    <div class="product-name">{{$product->title}}</div>
                    @if($product->offer)
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                {{$product->price}}</del></div>
                        <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                    @else
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="view-more-out">
            <div class="view-more-div">
                <a href="#">
                    <span class="view-more-in" style="">view more</span>
                </a>
            </div>
        </div>
    </div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Sport & Games</p>

        <div class="best-sales  row " >
            @foreach($sport as $product)
                <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                    <a href="{{route('product',$product->id)}}">
                    <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                    <div class="product-name">{{$product->title}}</div>
                    @if($product->offer)
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                {{$product->price}}</del></div>
                        <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                    @else
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="view-more-out">
            <div class="view-more-div">
                <a href="#">
                    <span class="view-more-in" style="">view more</span>
                </a>
            </div>
        </div>
    </div>

    <div class="product-with-viewmore ">
        <p class="best-sales-word">Home</p>
        <div class="best-sales  row " >
            @foreach($home as $product)
                <div class="col-md-2 col-2 first-slider-item product-inside-custom" style="margin-bottom: 10px">
                    <a href="{{route('product',$product->id)}}">
                    <img class="d-block w-100 product-img-slider" src="{{asset('images/products/'.$product->mainImage)}}"  alt="First slide">
                    <div class="product-name">{{$product->title}}</div>
                    @if($product->offer)
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->priceAfterOffer()}}</div><del class="price-del">NIS
                                {{$product->price}}</del></div>
                        <div class="green-card"><div class="green-card-in">{{$product->offer->discount}}% OFF</div></div>
                    @else
                        <div class="product-price"><div class="nis">NIS</div><div class="price-num">{{$product->price}}</div></div>
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="view-more-out">
            <div class="view-more-div">
                <a href="#">
                    <span class="view-more-in" style="">view more</span>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
