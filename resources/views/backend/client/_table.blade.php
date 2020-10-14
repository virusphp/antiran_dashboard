@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-client" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Nik Client</th>
            <th>Nama Client</th>
            <th>Alamat Client</th>
            <th>Kelamin</th>
            <th>No Telpon</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush