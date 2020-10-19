@push('css')
@include('datatables.datatables-css')
@endpush

<table id="tabel-users" class="table table-hover table-responsive-sm table-condensed table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th class="text-right">AKSI</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
@include('datatables.datatables-js')
@endpush