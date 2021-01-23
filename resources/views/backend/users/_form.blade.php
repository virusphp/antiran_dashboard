<div class="card-body">
    <div class="form-group">
        <label for="name">Nama</label>
        {!! Form::text('nama_pegawai', null, array('placeholder' => 'Nama Pegawai','class' => 'form-control '.($errors->has('nama_pegawai') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_pegawai', '<span class="invalid-feedback">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        {!! Form::text('kd_pegawai', null, array('placeholder' => 'username','class' => 'form-control '.($errors->has('kd_pegawai') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('kd_pegawai', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control '.($errors->has('password') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        {!! Form::password('password_confirmation', array('placeholder' => 'Password Confirmation','class' => 'form-control '.($errors->has('password_confirmation') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label for="roles">Role</label>
        {!! Form::select('role', ['' => 'Pilih role']+$roles, $user->exists ? $user->role : null , array('class' => 'form-control '.($errors->has('role') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="card-footer">
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="fa fa-dot-circle-o"></i> {{ isset($user->id) ? 'Update' : 'Simpan' }}
    </button>
</div>