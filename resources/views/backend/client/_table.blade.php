@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-client" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK CLIENT</th>
            <th>NAMA CLIENT</th>
            <th>ALAMAT CLIENT</th>
            <th>NO TELEPON</th>
            <th>NO WPWP</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush