<div class="card card-content" id="card-client">
    <form id="form-client">
        <div class="card-body">

            <div class="form-group row">

                <div class="col-md-12">
                    <label for="nama_client">NAMA CLIENT</label>
                    {!! Form::text('nama_client', null, array('placeholder' => 'NAMA CLIENT','class' => 'form-control '.($errors->has('nama_client') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="alamat_client">ALAMAT</label>
                    {!! Form::textarea('alamat_client', null, array('placeholder' => 'ALAMAT CLIENT','class' => 'form-control '.($errors->has('alamat_client') ? 'is-invalid' : ''), 'rows' => '2' ))!!}
                    {!! $errors->first('alamat_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="no_telepon">NOMOR TELEPON</label>
                    {!! Form::text('no_telepon', null, array('placeholder' => 'NOMOR TELEPON','class' => 'form-control '.($errors->has('no_telepon') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_telepon', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="npwp_client">NOMOR NPWP</label>
                    {!! Form::text('npwp_client', null, array('placeholder' => 'NOMOR NPWP','class' => 'form-control '.($errors->has('npwp_client') ? 'is-invalid' : ''), 'maxlength' => "15" ))!!}
                    {!! $errors->first('npwp_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" data-target="#card-pekerjaan" class="btn btn-primary btn-sm move">Selanjutnya</button>
        </div>
    </form>
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
    $(document).on('keyup', 'input[type=text], textarea', function() {
        $(this).val($(this).val().toUpperCase());
    })

    $('input[name=npwp_client').keyup(function() {
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



{{--
<div class="form-group row">
    <div class="col-md-6">
        <label for="email_client">EMAIL CLIENT</label>
        {!! Form::text('email_client', null, array('placeholder' => 'Email CLIENT','class' => 'form-control '.($errors->has('email_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('email_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div> --}}

{{-- <div class="col-md-6">
        <label for="nik_client">NIK</label>
        {!! Form::number('nik_client', null, array('placeholder' => 'NIK CLIENT','class' => 'form-control '.($errors->has('nik_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nik_client', '<span class="invalid-feedback">:message</span>') !!}
    </div> --}}

{{-- <div class="form-group row">
    <div class="col-md-6">
        <label for="tempat_lahir">TEMPAT LAHIR</label>
        {!! Form::text('tempat_lahir', null, array('placeholder' => 'TEMPAT LAHIR','class' => 'form-control '.($errors->has('tempat_lahir') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('tempat_lahir', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="tanggal_lahir">TANGGAL LAHIR</label>
        {!! Form::date('tanggal_lahir', isset($dataClient) ? $dataClient->tanggal_lahir : "dd/MM/yyyy", array('placeholder' => 'Tanggal Lahir', 'class' => 'form-control '.($errors->has('tanggal_lahir') ? 'is-invalid' : ''), 'id' => 'date-input')) !!}
        <span class="help-block">Isi tanggal lahir dengan Benar</span>
    </div>
</div> --}}

{{-- <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">JENIS KELAMIN</label>
            <div class="custom-control custom-radio col-md-3">
                {!! Form::radio('jenis_kelamin', 'L', false, array('id' => 'laki', 'class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('laki', 'Laki - Laki', [ 'class' => 'custom-control-label']) !!}
            </div>
        
            <div class="custom-control custom-radio col-md-3">
                {!! Form::radio('jenis_kelamin', 'P', false, array('id' => 'perempuan','class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('perempuan', 'Perempuan', [ 'class' => 'custom-control-label']) !!}
            </div>
            {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div> --}}