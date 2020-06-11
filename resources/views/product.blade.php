@extends('layouts.master_layout')
@push('style')
    <link href="{{asset('assets/css/product.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/css/index.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('js/jquery.elevatezoom.min.js')}}" type="text/javascript" rel="stylesheet">
    <title>GStore - product page</title>
@endpush
@section('content')
    <div id="app">
        <product-component :home-route="`{{route('home')}}`" :product="{{$product}}"></product-component>
    </div>
    <div class="product-with-viewmore " style="margin-left: 60px">
        <div class="row more-in-this">
            More in this Store
        </div>
        <div class="more-box  row " >
            @foreach($sellerProducts as $product)
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
        <div class="more-box  row " >

        </div>
        <div class="d-flex justify-content-center">
            <div class="view-more-box">
                <a href="#">
                    Go to Store
                </a>
            </div>
        </div>

        <div class="product-with-viewmore " style="margin-left: 60px">
        <div class="row more-in-this">
            <h4>Similar Products</h4>
        </div>
        <div class="more-box  row " >
            @foreach($similarProducts as $product)
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
        <div class="more-box  row " >

        </div>
        <div class="d-flex justify-content-center">
            <div class="view-more-box">
                <a href="#">
                    View more
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
     <script src="{{mix('js/app.js')}}"></script>
     <script>
          $('#showImage').elevateZoom();
     </script>
@endpush

