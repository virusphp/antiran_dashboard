@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-rujukan-keluar" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>NO Rujukan</th>
            <th>NO RM</th>
            <th>NAMA PASIEN</th>
            <th>TGL DIRUJUK</th>
            <th>TUJUAN</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush