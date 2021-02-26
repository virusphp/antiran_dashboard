<div class="row">

{{-- Form PROFIL --}}
<div id="profil-card" class="col-sm-6 col-md-4">
    <div class="card card-accent-info">
        <div class="card-header"><strong>Profil</strong> Pasien</div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="no_rm">No RM</label>
                    {!! Form::text('no_rm', null, array('placeholder' => 'No RM', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_rm') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_rm', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-8">
                    <label for="nama_pasien">Nama Pasien</label>
                    {!! Form::text('nama_pasien', null, array('placeholder' => 'Nama Pasien', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_pasien') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_pasien', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-6">
                    <label for="nik">No KTP</label>
                    {!! Form::text('nik', null, array('placeholder' => 'No KTP', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nik') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nik', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="jns_kel">Jenis Kelamin</label>
                    {!! Form::text('jns_kel', null, array('placeholder' => 'Jenis Kelamin', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('jns_kel') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('jns_kel', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
             <div class="form-group row">
                 <div class="col-md-6">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    {!! Form::text('tempat_lahir', null, array('placeholder' => 'No KTP', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tempat_lahir') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('tempat_lahir', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    {!! Form::text('tgl_lahir', null, array('placeholder' => 'Jenis Kelamin', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgl_lahir') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('tgl_lahir', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                   <label for="alamat">Alamat</label>
                   {!! Form::textarea('alamat', null, array('placeholder' => 'Alamat', 'tabindex' => '1', 'rows' => 2, 'class' => 'form-control form-control-sm'.($errors->has('alamat') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('alamat', '<span class="invalid-feedback">:message</span>') !!}
               </div>
           </div>
            <div class="form-group row">
                <div class="col-md-6">
                   <label for="rt">RT</label>
                   {!! Form::text('rt', null, array('placeholder' => 'RT', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('rt') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('rt', '<span class="invalid-feedback">:message</span>') !!}
               </div>
               <div class="col-md-6">
                   <label for="rw">RW</label>
                   {!! Form::text('rw', null, array('placeholder' => 'RW', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('rw') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('rw', '<span class="invalid-feedback">:message</span>') !!}
               </div>
           </div>
            <div class="form-group row">
                <div class="col-md-6">
                   <label for="kd_kelurahan">Kelurahan</label>
                   {!! Form::text('kd_kelurahan', null, array('placeholder' => 'Kelurahan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_kelurahan') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('kd_kelurahan', '<span class="invalid-feedback">:message</span>') !!}
               </div>
               <div class="col-md-6">
                   <label for="no_telp">No Hp</label>
                   {!! Form::text('no_telp', null, array('placeholder' => 'Nomor Telp', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_telp') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('no_telp', '<span class="invalid-feedback">:message</span>') !!}
               </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="kd_suku_bangsa">Suku Bangsa</label>
                    {!! Form::text('kd_suku_bangsa', null, array('placeholder' => 'Suku Bangsa', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_suku_bangsa') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_suku_bangsa', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="kd_agama">Pekerjaan</label>
                    {!! Form::text('kd_agama', null, array('placeholder' => 'Agama', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_agama') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_agama', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="kd_pendidikan">Pendidikan</label>
                    {!! Form::text('kd_pendidikan', null, array('placeholder' => 'Pendidikan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_pendidikan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_pendidikan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="kd_pekerjaan">Pekerjaan</label>
                    {!! Form::text('kd_pekerjaan', null, array('placeholder' => 'Pekerjaan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_pekerjaan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_pekerjaan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Form BIODATA --}}
<div id="biodata-card" class="col-sm-6 col-md-8">
    <div class="card card-accent-info">
        <div class="card-header"><strong>Biodata</strong> Pasien</div>
        <div class="card-body">

            <div class="form-group row">
                <div class="col-md-6">
                   <label for="nama_pasangan">Nama Pasangan</label>
                   {!! Form::text('nama_pasangan', null, array('placeholder' => 'Nama Pesangan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_pasangan') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('nama_pasangan', '<span class="invalid-feedback">:message</span>') !!}
               </div>
               <div class="col-md-6">
                   <label for="pekerjaan_pasangan">Pekerjaan Pasangan</label>
                   {!! Form::text('pekerjaan_pasangan', null, array('placeholder' => 'Pekerjaan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('pekerjaan_pasangan') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('pekerjaan_pasangan', '<span class="invalid-feedback">:message</span>') !!}
               </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="no_telp_pasangan">No Telp</label>
                    {!! Form::text('no_telp_pasangan', null, array('placeholder' => 'No Telpon', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_telp_pasangan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_telp_pasangan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-8">
                    <label for="alamat_pasangan">Alamat Pasangan</label>
                    {!! Form::text('alamat_pasangan', null, array('placeholder' => 'Alamat Pasangan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('alamat_pasangan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('alamat_pasangan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="nama_orang_tua">Orang Tua</label>
                    {!! Form::text('nama_orang_tua', null, array('placeholder' => 'Orang Tua', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_orang_tua') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_orang_tua', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="nama_ayah">Nama Ayah</label>
                    {!! Form::text('nama_ayah', null, array('placeholder' => 'Nama Ayah', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_ayah') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_ayah', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="kd_pekerjaan_ayah">Pekerjaan Ayah</label>
                    {!! Form::text('kd_pekerjaan_ayah', null, array('placeholder' => 'Pekerjaan Ayah', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_pekerjaan_ayah') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_pekerjaan_ayah', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="tgl_lahir_ayah">Tanggal Lahir Ayah</label>
                    {!! Form::text('tgl_lahir_ayah', null, array('placeholder' => 'Tanggal lahir Ayah', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgl_lahir_ayah') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('tgl_lahir_ayah', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="nama_ibu">Nama Ibu</label>
                    {!! Form::text('nama_ibu', null, array('placeholder' => 'Nama Ibu', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_ibu') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_ibu', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="kd_pekerjaan_ibu">Pekerjaan Ibu</label>
                    {!! Form::text('kd_pekerjaan_ibu', null, array('placeholder' => 'Pekerjaan Ibu', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kd_pekerjaan_ibu') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('kd_pekerjaan_ibu', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="tgl_lahir_ibu">Tanggal Lahir Ibu</label>
                    {!! Form::text('tgl_lahir_ibu', null, array('placeholder' => 'Tanggal Lahir', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgL_lahir_ibu') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('tgl_lahir_ibu', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
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
    