    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-edit"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm',
        'id'    => 'edit-rujukan',
        'data-sep' => $no_sep
    ]) !!}
    {{-- {{ dd($idx)}} --}}
	{!! Form::button('<i class="c-icon c-icon-2x1 fa fa-print"></i>', [
		'type'  => 'button',
		'class' => 'btn btn-info btn-sm btn-xs',
        'id'    => 'print-rujukan',
        'data-sep' => $no_sep,
        'data-rujukan' => $no_rujukan
	]) !!}