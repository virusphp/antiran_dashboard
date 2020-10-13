<table class="table table-hover table-responsive-sm table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Nik Client</th>
            <th>Nama Client</th>
            <th>Alamat Client</th>
            <th>Jenis Kelamin</th>
            <th>No Telpon</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($client as $d)
        <tr>
            <td>{{ $loop->iteration + $client->firstItem() - 1 }}</td>
            <td>
                {!! $d->nik_client !!}
            </td>
            <td>
                {!! $d->nama_client !!}
            </td>
            <td>
                {!! $d->alamat_client !!}
            </td>
            <td>
                {!! $d->jenis_kelamin !!}
            </td>
            <td>
                {!! $d->no_telepon !!}
            </td>
            <td class="text-right">
                <a href="{{ route('client.edit',$d->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                <button class="btn btn-outline-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>