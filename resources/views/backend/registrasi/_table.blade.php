@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-registrasi" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>NO REG</th>
            <th>NO RM</th>
            <th>NAMA PASIEN</th>
            <th>TGL REG</th>
            <th>BAYAR</th>
            <th>NO SEP</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush