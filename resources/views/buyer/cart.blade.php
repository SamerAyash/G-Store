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
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                size: 'large',
                color: 'gold',
                shape: 'pill',
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/create-payment')
                    .then(function(res) {
                        // 3. Return res.id from the response
                        // console.log(res);
                        return res.id;
                    });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/execute-payment', {
                    paymentID: data.paymentID,
                    payerID:   data.payerID
                })
                    .then(function(res) {
                        console.log(res);
                        alert('PAYMENT WENT THROUGH!!');
                        // 3. Show the buyer a confirmation message.
                    });
            }
        }, '#paypal-button');
    </script>
    <script src="{{mix('js/app.js')}}"></script>
    <link href="{{asset('assets/css/cart.css')}}" rel="stylesheet">

@endpush

