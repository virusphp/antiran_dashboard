<div class="form-group row">
    <div class="col-md-6">
        <label for="nama_proses">NAMA PEKERJAAN</label>
        {!! Form::text('nama_proses', null, array('placeholder' => 'NAMA PEKERJAAN','class' => 'form-control '.($errors->has('nama_proses') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_proses', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="waktu_proses">WAKTU PROSES</label>
        {!! Form::number('waktu_proses', null, ['placeholder'=>'WAKTU PROSES','class'=>'form-control'.($errors->has('waktu_proses') ? 'is-invalid' : '')]) !!}
        {!! $errors->first('waktu_proses', '<span class="in valid-feedback">:message</span>') !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="status_proses">STATUS PEKERJAAN</label>
        {!! Form::select('status_proses', ['1' => 'Milik BPN', '0' => 'Semua Pekerjaan'], null, ['placeholder' => '-- Pilih Status Pekerjaan --','class'=>'form-control'.($errors->has('status_proses') ? ' is-invalid' : '')]) !!}

        {{-- <select name="status_proses" id="status_proses" class="form-control{!! ($errors->has('status_proses') ? 'is-invalid' : '')!!}">
            <option disabled selected>--Pilih--</option>
            <option value="1">Milik BPN</option>
            <option value="0">Semua Pekerjaan</option>
        </select> --}}
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('coreui/datepicker/css/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('coreui/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        // function helper uppercase to text and textarea
        $(document).on('keyup', 'input[type=text]', function() {
            $(this).val($(this).val().toUpperCase());
        })
    </script>
@endpush
