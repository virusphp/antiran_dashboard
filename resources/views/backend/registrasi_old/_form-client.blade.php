<div class="card card-content" id="card-client">
    <form id="form-client" class="form-input">
        @csrf
        <div class="card-body">

            <div class="form-group row">

                <div class="col-md-12">
                    <label for="nama_client">NAMA CLIENT</label>
                    {!! Form::text('nama_client', null, array('required'=>'true', 'placeholder' => 'NAMA CLIENT','class' => 'form-control '.($errors->has('nama_client') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="alamat_client">ALAMAT</label>
                    {!! Form::textarea('alamat_client', null, array('required'=>'true','placeholder' => 'ALAMAT CLIENT','class' => 'form-control '.($errors->has('alamat_client') ? 'is-invalid' : ''), 'rows' => '2' ))!!}
                    {!! $errors->first('alamat_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="no_telepon">NOMOR TELEPON</label>
                    {!! Form::text('no_telepon', null, array('required'=>'true','placeholder' => 'NOMOR TELEPON','class' => 'form-control '.($errors->has('no_telepon') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_telepon', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="npwp_client">NOMOR NPWP</label>
                    {!! Form::text('npwp_client', null, array('required'=>'true','placeholder' => 'NOMOR NPWP','class' => 'form-control '.($errors->has('npwp_client') ? 'is-invalid' : ''), 'maxlength' => "22" ))!!}
                    {!! $errors->first('npwp_client', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" data-validate="#form-client" data-target="#card-pekerjaan" class="btn btn-primary btn-sm move">Selanjutnya</button>
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

    $('input[name=nama_client').keyup(function() {
        $('#nama_client-text').html($(this).val());
    })


    // function helper can move to helper js
    function formatNpwp(value) {
        if (typeof value === 'string') {
            return value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6');
        }
    }
</script>
@endpush