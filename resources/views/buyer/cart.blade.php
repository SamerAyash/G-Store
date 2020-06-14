@extends('layouts.master_layout')
@push('style')
    <link href="{{asset('assets/css/index.css')}}" rel="stylesheet">
{{--
    <link href="{{asset('assets/css/cart.css')}}" type="text/css" rel="stylesheet">
--}}
    <title>Cart page</title>
@endpush
@section('content')
    <div class="row row-background">
        <div class="dropdown col-sm-2">
        </div>
        @foreach($categories as $category)
            <a href="#" class="btn  bar-item" >{{$category->name}}</a>
        @endforeach
    </div>
    <div id="app">
        <cart-component :carts="{{$carts}}"></cart-component>
    </div>
@endsection
@push('scripts')
    <script src="{{mix('js/app.js')}}"></script>
    <link href="{{asset('assets/css/cart.css')}}" rel="stylesheet">
@endpush

