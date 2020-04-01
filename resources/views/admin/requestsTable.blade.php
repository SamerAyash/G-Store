@extends('admin.index')
@section('content')
    <div id="app">
       <h4>Requests and Complaints :</h4>
        <div>
            <br>
            <br>
        </div>
        <div>
            <requests-table></requests-table>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
