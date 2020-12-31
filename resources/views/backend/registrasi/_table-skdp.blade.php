@push('css')
	@include('datatables.datatables-css')
@endpush

<table id="tabel-skdp" class="table table-sm table-hover table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <td>NO SURAT KONTROL</td>
            <td>POLI DPJP</td>
            <td>NO RUJUKAN</td>
            <td>JENIS SURAT</td>
            <td>NAMA DOKTER</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    @include('datatables.datatables-js')
@endpush