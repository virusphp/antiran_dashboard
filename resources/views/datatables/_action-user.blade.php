<a href="{{ $edit_url }}" class='btn btn-warning btn-sm btn-xs'>
        <i class="c-icon c-icon-2x1 cil-pencil"></i>
    </a>
    
	{!! Form::button('<i class="c-icon c-icon-2x1 cil-x"></i>', [
		'type'  => 'button',
		'class' => 'btn btn-danger btn-sm btn-xs',
        'id'    => 'delete-user',
        'data-idx' => $idx,
        'data-name' => $name
	]) !!}