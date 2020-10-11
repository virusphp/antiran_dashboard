<table class="table table-hover table-responsive-sm table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pegawai</th>
            <th>Dibuat</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pegawai as $d)
        <tr>
            <td>{{ $loop->iteration + $divisi->firstItem() - 1 }}</td>
            <td>
                {!! $d->nama !!}
            </td>
            <td>{{ tanggal($d->created_at) }}</td>
            <td class="text-right">
                <a href="{{ route('divisi.edit',$d->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                <button @click='hapus(@json(route("divisi.destroy",$d->id)))' class="btn btn-outline-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>