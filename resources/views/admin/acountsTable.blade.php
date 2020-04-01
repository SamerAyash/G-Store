@extends('admin.index')
@section('content')
    <div id="app">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <router-link class="nav-item nav-link"  :to="{name:'buyersTable'}" exact-active-class="active">Buyers</router-link>
                <router-link class="nav-item nav-link" :to="{name:'sellersTable'}" exact-active-class="active">Sellers</router-link>
                @if(Auth::guard('admin')->user()->type == 'superAdmin')
                    <router-link class="nav-item nav-link" :to="{name:'supervisorsTable'}" exact-active-class="active">Supervisors</router-link>
                    <router-link class="nav-item nav-link"  :to="{name:'deliverysTable'}" exact-active-class="active">Delivery</router-link>
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
@endpush
