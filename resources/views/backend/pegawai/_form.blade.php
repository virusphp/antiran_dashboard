<div class="form-group row">
    <div class="col-md-6">
        <label for="kode_pegawai">KD PEGAWAI</label>
        {!! Form::text('kode_pegawai', null, array('placeholder' => 'Kode Pegawai','class' => 'form-control '.($errors->has('kode_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('kode_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="nik_pegawai">NIK</label>
        {!! Form::text('nik_pegawai', null, array('placeholder' => 'Nik Pegawai','class' => 'form-control '.($errors->has('nik_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nik_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="nama_pegawai">Nama Pegawai</label>
        {!! Form::text('nama_pegawai', null, array('placeholder' => 'Nama Pegawai','class' => 'form-control '.($errors->has('nama_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        {!! Form::text('jenis_kelamin', null, array('placeholder' => 'Jenis Kelamin','class' => 'form-control '.($errors->has('jenis_kelamin') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('jenis_kelamin', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="tempat_lahir">Tempat Lahir</label>
        {!! Form::text('tempat_lahir', null, array('placeholder' => 'Tempat Lahir','class' => 'form-control '.($errors->has('tempat_lahir') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('tempat_lahir', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        {!! Form::text('tanggal_lahir', null, array('placeholder' => 'Tanggal Lahir','class' => 'form-control '.($errors->has('tanggal_lahir') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('tanggal_lahir', '<span class="invalid-feedback">:message</span>') !!} </div>
    </div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="alamat_pegawai">Alamat Pegawai</label>
        {!! Form::text('alamat_pegawai', null, array('placeholder' => 'Alamat Pegawai','class' => 'form-control '.($errors->has('alamat_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('alamat_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="no_telepon">Nomor Telepon</label>
        {!! Form::text('no_telepon', null, array('placeholder' => 'Nomor Telepon','class' => 'form-control '.($errors->has('no_telepon') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('no_telepon', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="email_pegawai">Email Pegawai</label>
        {!! Form::text('email_pegawai', null, array('placeholder' => 'Email Pegawai','class' => 'form-control '.($errors->has('email_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('email_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    <div class="col-md-6">
        <label for="npwp_pegawai">Nomor NPWP</label>
        {!! Form::text('npwp_pegawai', null, array('placeholder' => 'Nomor NPWP','class' => 'form-control '.($errors->has('npwp_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('npwp_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>
    