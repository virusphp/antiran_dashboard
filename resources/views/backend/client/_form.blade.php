<div class="form-group row">
    <div class="col-md-6">
        <label for="kode_client">KODE CLIENT</label>
        {!! Form::text('kode_client', null, array('placeholder' => 'KODE CLIENT','class' => 'form-control '.($errors->has('kode_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('kode_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="nik_client">NIK</label>
        {!! Form::text('nik_client', null, array('placeholder' => 'NIK CLIENT','class' => 'form-control '.($errors->has('nik_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nik_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="nama_client">NAMA CLIENT</label>
        {!! Form::text('nama_client', null, array('placeholder' => 'NAMA CLIENT','class' => 'form-control '.($errors->has('nama_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">JENIS KELAMIN</label>
            <div class="custom-control custom-radio">
                {!! Form::radio('jenis_kelamin', 'L', false, array('id' => 'laki', 'class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('laki', 'Laki - Laki', [ 'class' => 'custom-control-label']) !!}
            </div>
        
            <div class="custom-control custom-radio">
                {!! Form::radio('jenis_kelamin', 'P', false, array('id' => 'perempuan','class' => 'custom-control-input '.($errors->has('jenis_kelamin') ? 'is-invalid' : ''))) !!}
                {!! Form::label('perempuan', 'Perempuan', [ 'class' => 'custom-control-label']) !!}
            </div>
            {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="tempat_lahir">TEMPAT LAHIR</label>
        {!! Form::text('tempat_lahir', null, array('placeholder' => 'TEMPAT LAHIR','class' => 'form-control '.($errors->has('tempat_lahir') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('tempat_lahir', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="tanggal_lahir">TANGGAL LAHIR</label>
        {!! Form::date('tanggal_lahir', null, array('placeholder' => 'Tanggal Lahir', 'class' => 'form-control '.($errors->has('tanggal_lahir') ? 'is-invalid' : ''), 'id' => 'date-input')) !!}
        {{-- <input class="form-control" id="date-input" type="date" name="tanggal_lahir" placeholder="Tanggal Lahir"> --}}
        <span class="help-block">Isi tanggal lahir dengan Benar</span>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="alamat_client">ALAMAT</label>
        {!! Form::text('alamat_client', null, array('placeholder' => 'ALAMAT CLIENT','class' => 'form-control '.($errors->has('alamat_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('alamat_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="no_telepon">NOMOR TELEPON</label>
        {!! Form::text('no_telepon', null, array('placeholder' => 'NOMOR TELEPON','class' => 'form-control '.($errors->has('no_telepon') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('no_telepon', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="email_client">Email CLIENT</label>
        {!! Form::text('email_client', null, array('placeholder' => 'Email CLIENT','class' => 'form-control '.($errors->has('email_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('email_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="npwp_client">NOMOR NPWP</label>
        {!! Form::text('npwp_client', null, array('placeholder' => 'NOMOR NPWP','class' => 'form-control '.($errors->has('npwp_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('npwp_client', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(function () {
          $('#datetimepicker8').datetimepicker({
              icons: {
                  time: "fa fa-clock-o",
                  date: "fa fa-calendar",
                  up: "fa fa-arrow-up",
                  down: "fa fa-arrow-down"
              }
          });
      });
    </script> 
@endpush
    