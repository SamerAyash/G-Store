@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Admins</h3>
        </div>
        <div class="box-body">
            {!! $dataTable->table([
            'class'=>'dataTable table table-striped table-hover table-bordered'
            ]) !!}
        </div>
    </div>

@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{$dataTable->scripts()}}
@endpush
