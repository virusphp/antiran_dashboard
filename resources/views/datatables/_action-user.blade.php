<a href="{{ $edit_url }}" class='btn btn-warning btn-sm'>
        <i class="c-icon c-icon-2x1 fa fa-edit"></i>
    </a>
    
	{!! Form::button('<i class="c-icon c-icon-2x1 fa fa-trash"></i>', [
		'type'  => 'button',
		'class' => 'btn btn-danger btn-sm',
        'id'    => 'delete-user',
        'data-idx' => $idx,
        'data-name' => $name
	]) !!}