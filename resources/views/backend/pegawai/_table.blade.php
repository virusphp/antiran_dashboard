@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-divisi" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>KODE DIVISI</th>
            <th>NAMA DIVISI</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush