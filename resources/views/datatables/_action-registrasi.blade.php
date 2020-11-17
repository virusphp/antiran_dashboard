@if ($no_sep <= 15 && $status_keluar != 2 && $cara_bayar != 1 && $cara_bayar != 9)
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-pencil"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm btn-xs',
        'id'    => 'buat-sep',
        'data-reg' => $no_reg
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-external-link"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm btn-xs',
        'id'    => 'edit-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm btn-xs',
        'id'    => 'print-sep',
        'disabled'
    ]) !!}
@elseif($status_keluar == 2) 
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-pencil"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm btn-xs',
        'id'    => 'buat-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-external-link"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm btn-xs',
        'id'    => 'edit-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm btn-xs',
        'id'    => 'print-sep',
        'disabled'
    ]) !!}
@else
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-pencil"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm btn-xs',
        'id'    => 'buat-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-external-link"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm btn-xs',
        'id'    => 'edit-sep',
        'data-sep' => $no_sep
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 cil-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm btn-xs',
        'id'    => 'print-sep',
        'data-sep' => $no_sep
    ]) !!}
@endif
