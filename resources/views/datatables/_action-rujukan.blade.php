    <a href="{{ $edit_url }}" class='btn btn-warning btn-sm btn-xs'>
        <i class="c-icon c-icon-2x1 fa fa-edit"></i>
    </a>
    {{-- {{ dd($idx)}} --}}
	{!! Form::button('<i class="c-icon c-icon-2x1 fa fa-print"></i>', [
		'type'  => 'button',
		'class' => 'btn btn-info btn-sm btn-xs',
        'id'    => 'print-rujukan',
        'data-sep' => $no_sep,
        'data-rujukan' => $no_rujukan
	]) !!}