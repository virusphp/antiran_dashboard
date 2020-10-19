<div class="card-body">
    <div class="form-group">
        <label for="name">Nama</label>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control '.($errors->has('name') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('name', '<span class="invalid-feedback">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control '.($errors->has('username') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control '.($errors->has('email') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
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
        {!! Form::select('roles', ['' => 'Pilih role']+$roles, $user->exists ? $user->roles->first()->name : null , array('class' => 'form-control '.($errors->has('roles') ? 'is-invalid' : ''))) !!}
        {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="card-footer">
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="fa fa-dot-circle-o"></i> {{ isset($user->id) ? 'Update' : 'Simpan' }}
    </button>
</div>