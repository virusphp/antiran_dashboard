@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-rujukan" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>NO RUJUKAN</th>
            <th>TGL RUJUKAN</th>
            <th>NAMA PASIEN</th>
            <th>SUB SPESIALIS</th>
            <th>PELAYANAN</th>
            <th>PPK PERUJUK</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush