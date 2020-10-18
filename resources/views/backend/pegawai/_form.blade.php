<div class="form-group row">
    <div class="col-md-6">
        <label for="nama_pegawai">NAMA PEGAWAI</label>
        {!! Form::text('nama_pegawai', null, array('placeholder' => 'NAMA PEGAWAI', 'tabindex' => '1', 'class' => 'form-control '.($errors->has('nama_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="tempat_lahir">TEMPAT LAHIR</label>
        {!! Form::text('tempat_lahir', null, array('placeholder' => 'TEMPAT LAHIR', 'tabindex' => '1', 'class' => 'form-control '.($errors->has('tempat_lahir') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('tempat_lahir', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="tanggal_lahir">TANGGAL LAHIR</label>
        {!! Form::date('tanggal_lahir', isset($dataClient) ? $dataClient->tanggal_lahir : "dd/MM/yyyy", array('tabindex' => '1', 'placeholder' => 'Tanggal Lahir', 'class' => 'form-control '.($errors->has('tanggal_lahir') ? 'is-invalid' : ''), 'id' => 'date-input')) !!}
        <span class="help-block">Isi tanggal lahir dengan Benar</span>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">JENIS KELAMIN</label>
            <div class="custom-control custom-radio col-md-3">
                {!! Form::radio('jenis_kelamin', 'L', false, array('tabindex' => '1', 'id' => 'laki', 'class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('laki', 'Laki - Laki', [ 'class' => 'custom-control-label']) !!}
            </div>
        
            <div class="custom-control custom-radio col-md-3">
                {!! Form::radio('jenis_kelamin', 'P', false, array('tabindex' => '1', 'id' => 'perempuan','class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('perempuan', 'Perempuan', [ 'class' => 'custom-control-label']) !!}
            </div>
            {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="divisi_id">DIVISI</label>
        {!! Form::select('divisi_id', $divisi, null, array('id'=> 'divisi','placeholder' => 'DIVISI', 'tabindex' => '1', 'class' => 'form-control '.($errors->has('divisi_id') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('divisi_id', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('coreui/datepicker/css/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('coreui/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('input[name=nama_pegawai]').focus();
        $('#divisi').select2({
            placeholder : 'Pilih Divisi'
        });
        // function helper uppercase to text and textarea
        $(document).on('keyup', 'input[type=text], textarea', function() {
            $(this).val($(this).val().toUpperCase());
        })

        $('input[name=npwp_pegawai').keyup(function() {
            $(this).val(formatNpwp($(this).val()));
        }) 

        // function helper can move to helper js
        function formatNpwp(value) {
            if (typeof value === 'string') {
                return value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6');
            }
        }
    </script> 
@endpush
    