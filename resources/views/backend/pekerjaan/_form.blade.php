<div class="form-group row">

    <!-- Nama Pekerjaan Form -->
    <div class="col-md-6">
        <label for="nama_pekerjaan">Nama Pekerjaan</label>
        {!! Form::text('nama_pekerjaan', null, array('placeholder' => 'Nama Pekerjaan','class' => 'form-control '.($errors->has('nama_pekerjaan') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_pekerjaan', '<span class="invalid-feedback">:message</span>') !!}
    </div>
    
    <div class="col-md-6">
        <label for="insentif_pekerjaan">Insentif</label>

        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text">
                    Rp
                </span>
            </div>

            {!! Form::text('insentif_pekerjaan', null, array('placeholder' => 'Insentif','class' => 'form-control money '.($errors->has('insentif_pekerjaan') ? 'is-invalid' : '') ))!!}

        </div>
        {!! $errors->first('insentif_pekerjaan', '<span class="invalid-feedback">:message</span>') !!}

    </div>

    <!-- Keterangan Form -->
    <div class="col-md-12">
        <label for="keterangan_pekerjaan">Keterangan</label>
        {!! Form::textarea('keterangan_pekerjaan', null, array('placeholder' => 'KETERANGAN PEKERJAAN','class' => 'form-control '.($errors->has('keterangan_pekerjaan') ? 'is-invalid' : ''), 'rows' => '2' ))!!}
        {!! $errors->first('keterangan_pekerjaan', '<span class="invalid-feedback">:message</span>') !!}
    </div>

</div>


@push('scripts')
<script src="{{ asset('lib/jquery.mask/jquery.mask.min.js') }}"></script>

<script type="text/javascript">
    $('.money').mask('000.000.000.000.000', {reverse: true});

    $('input[type=text]').keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

</script>
@endpush