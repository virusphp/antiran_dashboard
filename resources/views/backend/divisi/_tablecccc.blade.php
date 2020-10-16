{!! $dataTable->table(['width' => '100%', 'class' => 'table-responsive table-striped']) !!}

@push('css')
<link rel="stylesheet" href="{{ asset('lib/DataTables/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/DataTables/buttons.bootstrap.min.css') }}">
@endpush
@push('scripts')
	<!-- DataTables -->
    <script src="{{ asset('lib/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> 
    {!! $dataTable->scripts() !!}
@endpush
{{-- Explore lagi service ini kedepannya --}}