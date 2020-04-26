@extends('admin.index')
@section('content')
    <div id="app">
        <h4>Outstanding products and offers :</h4>
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @if(admin()->user()->hasPermission('manage products'))
                    <router-link class="nav-item nav-link"  :to="{name:'productsTable'}" exact-active-class="active">Products</router-link>
                @endif
                @if(admin()->user()->hasPermission('manage offers'))
                    <router-link class="nav-item nav-link"  :to="{name:'offersTable'}" exact-active-class="active">Offers</router-link>
                @endif
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{mix('js/app.js')}}"></script>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <input type="hidden" name="_token" value="@csrf">"
@endpush
