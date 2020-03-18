@extends('admin.index')

@section('content')
    <buyers-table></buyers-table>
@endsection
@push('scripts')
<script src="{{mix('js/app.js')}}"></script>
@endpush
