<div class="form-group row">
    <div class="col-lg-12">
        <label for="divisi">Divisi</label>
        {!! Form::text('nama', null, array('placeholder' => 'Name','class' => 'form-control '.($errors->has('nama') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama', '<span class="invalid-feedback">:message</span>') !!}
    </div>
</div>