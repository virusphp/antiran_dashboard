@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-antrian" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>NAMA POLIKLINIK</th>
            <th>JUMLAH ANTRIAN</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush