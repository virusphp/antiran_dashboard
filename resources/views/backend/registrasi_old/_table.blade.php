@push('css')
@include('datatables.datatables-css')
@endpush
<table id="tabel-registrasi" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>NO REGISTRASI</th>
            <th>NAMA CLIENT</th>
            <th>NAMA PEKERJAAN</th>
            <th>NO AKTA</th>
            <th>LOKASI AKTA</th>
            <th>TANGGAL REGISTRASI</th>

            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
@include('datatables.datatables-js')
@endpush