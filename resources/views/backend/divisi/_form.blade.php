<div class="form-group row">
    <div class="col-md-12">
        <label for="nama_divisi">NAMA DIVISI</label>
        {!! Form::text('nama_divisi', null, array('placeholder' => 'NAMA DIVISI', 'tabindex' => '1', 'class' => 'form-control '.($errors->has('nama_client') ? 'is-invalid' : '') ))!!}
        {!! $errors->first('nama_divisi', '<span class="invalid-feedback">:message</span>') !!}
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
        $('input[name=nama_divisi]').focus();
       
        // function helper uppercase to text and textarea
        $(document).on('keyup', 'input[type=text], textarea', function() {
            $(this).val($(this).val().toUpperCase());
        })

        $('input[name=npwp_divisi').keyup(function() {
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
    