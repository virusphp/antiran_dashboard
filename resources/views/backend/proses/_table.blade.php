@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-proses" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Proses</th>
            <th>Waktu Proses</th>
            <th>Status Proses</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush
