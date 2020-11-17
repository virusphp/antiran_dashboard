    <a href="{{ $edit_url }}" class='btn btn-warning btn-sm btn-xs'>
        <i class="c-icon c-icon-2x1 cil-bell"></i>
    </a>
    {{-- {{ dd($idx)}} --}}
	{!! Form::button('<i class="c-icon c-icon-2x1 cil-chevron-double-right"></i>', [
		'type'  => 'button',
		'class' => 'btn btn-danger btn-sm btn-xs',
        'id'    => 'delete-pasien',
        'data-idx' => $idx,
        'data-nama' => $nama_pasien
	]) !!}