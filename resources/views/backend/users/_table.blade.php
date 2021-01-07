@push('css')
@include('datatables.datatables-css')
@endpush

<table id="tabel-users" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Roles</th>
            <th>Unit Kerja</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
@include('datatables.datatables-js')
@endpush