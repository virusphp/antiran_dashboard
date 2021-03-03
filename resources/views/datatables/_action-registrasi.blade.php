{{-- {{ dd(strlen($no_sep), $status_keluar, $cara_bayar) }} --}}
@if (strlen($no_sep) <= 15 && $status_keluar != 2 && $cara_bayar == 8)
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-id-card"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm',
        'id'    => 'buat-sep',
        'data-reg' => $no_reg
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-edit"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm',
        'id'    => 'edit-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm',
        'id'    => 'print-sep',
        'disabled'
    ]) !!}
@elseif($status_keluar == 2 || $cara_bayar != 8) 
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-id-card"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm',
        'id'    => 'buat-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-edit"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm',
        'id'    => 'edit-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm',
        'id'    => 'print-sep',
        'disabled'
    ]) !!}
@else
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-id-card"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-primary btn-sm',
        'id'    => 'buat-sep',
        'disabled'
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-edit"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-warning btn-sm',
        'id'    => 'edit-sep',
        'data-reg' => $no_reg
    ]) !!}
    {!! Form::button('<i class="c-icon c-icon-2x1 fa fa-print"></i>', [
        'type'  => 'button',
        'class' => 'btn btn-success btn-sm',
        'id'    => 'print-sep',
        'data-reg' => $no_reg
    ]) !!}
@endif
