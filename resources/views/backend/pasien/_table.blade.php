@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-pasien" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>NO RM</th>
            <th>NAMA PASIEN</th>
            <th>ALAMAT PASIEN</th>
            <th>NO KARTU</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush