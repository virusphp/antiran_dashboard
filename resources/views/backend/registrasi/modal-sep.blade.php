<div class="modal fade" id="modal-sep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">

         {{-- Form PROFIL --}}
<div id="profil-card" class="col-sm-6 col-md-4">
    <div class="card card-accent-dark">
        <div class="card-header"><strong>Profil</strong> Pasien</div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="no_reg">No Registrasi</label>
                    {!! Form::text('no_reg', null, array('placeholder' => 'No Reg', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_reg') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_reg', '<span class="invalid-feedback">:message</span>') !!}
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
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    {!! Form::text('tgl_lahir', null, array('placeholder' => 'Tanggal Lahir', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgl_lahir') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('tgl_lahir', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
             <div class="form-group row">
                 <div class="col-md-6">
                    <label for="hak_kelas">Hak Kelas</label>
                    {!! Form::text('hak_kelas', null, array('placeholder' => 'Hak Kelas', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('hak_kelas') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('hak_kelas', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-6">
                    <label for="peserta">Peserta</label>
                    {!! Form::text('peserta', null, array('placeholder' => 'Peserta', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgl_lahir') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('peserta', '<span class="invalid-feedback">:message</span>') !!}
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
                <div class="col-md-12">
                   <label for="cara_bayar">Cara Bayar</label>
                   {!! Form::text('cara_bayar', null, array('placeholder' => 'Cara Bayar', 'tabindex' => '1', 'rows' => 2, 'class' => 'form-control form-control-sm'.($errors->has('cara_bayar') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('cara_bayar', '<span class="invalid-feedback">:message</span>') !!}
               </div>
            </div>
        </div>
    </div>
</div>

{{-- Form BIODATA --}}
<div id="biodata-card" class="col-sm-6 col-md-8">
    <div class="card card-accent-dark">
        <div class="card-header">
            <strong>Pembuatan Sep</strong> 
            <small id="nama-pelayanan"><b></b></small>
            <small class="float-right" id="poli-tujuan"><b></b></small>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <div class="col-md-4">
                   <label for="no_kartu">Nomor Kartu</label>
                   {!! Form::text('no_kartu', null, array('placeholder' => 'Nomor Kartu', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_kartu') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('no_kartu', '<span class="invalid-feedback">:message</span>') !!}
               </div>
               <div class="col-md-4">
                   <label for="no_rm">COB | No RM</label>
                   {!! Form::text('no_rm', null, array('placeholder' => 'Nomor RM', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_rm') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('no_rm', '<span class="invalid-feedback">:message</span>') !!}
               </div>
                <div class="col-md-4">
                   <label for="tgl_rujukan">Tanggal Rujukan</label>
                   {!! Form::text('tgl_rujukan', null, array('placeholder' => 'Tanggal Rujukan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tgl_rujukan') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('tgl_rujukan', '<span class="invalid-feedback">:message</span>') !!}
               </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="no_rujukan">No Rujukan</label>
                    <input class="btn btn-ghost-primary btn-cus" id="cari_rujukan" type="button" value="Pcare">
                    <input class="btn btn-ghost-primary btn-cus" id="cari_rujukan_rs" type="button" value="RS">
                    <input class="btn btn-ghost-primary btn-cus float-right" id="cari_sko" type="button" value="SKO">
                    {!! Form::text('no_rujukan', null, array('placeholder' => 'No Rujukan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_rujukan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_rujukan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="asal_rujukan">Asal Rujukan</label>
                    {!! Form::text('asal_rujukan', null, array('placeholder' => 'Asal Rujukan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('asal_rujukan') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('asal_rujukan', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="ppk_perujuk">PPK Rujukan / Perujuk</label>
                    {!! Form::text('ppk_perujuk', null, array('placeholder' => 'PPK Perujuk', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('ppk-perujuk') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('ppk_perujuk', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="diagnosa">Diagnosa</label>
                    {!! Form::text('diagnosa', null, array('placeholder' => 'Diagnosa Rujukan', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('diagnosa') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('diagnosa', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="nama_poli">Eksekutif | Spe / Subspesialis</label>
                    {!! Form::text('nama_poli', null, array('placeholder' => 'Nama Poli', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_poli') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('nama_poli', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-4">
                    <label for="no_telp">No Telp</label>
                    {!! Form::text('no_telp', null, array('placeholder' => 'No Telpon', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_telpon') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_telp', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>

            {{-- FORM SKDP --}}
            <div id="form-skdp" class="form-group row">
                <div class="col-md-4">
                    <label for="no_surat">Nama Ibu</label>
                    <input class="btn btn-ghost-primary btn-cus" id="cari_skdp" type="button" value="skdp">
                    {!! Form::text('no_surat', null, array('placeholder' => 'No SKDP', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_surat') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('no_surat', '<span class="invalid-feedback">:message</span>') !!}
                </div>
                <div class="col-md-8">
                    <label for="nama_dpjp">DPJP Pemberi Surat / SKDP</label>
                    {!! Form::text('nama_dpjp', null, array('placeholder' => 'Nama DPJP', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('nama_dpjp') ? 'is-invalid' : '') ))!!}
                    {!! $errors->first('naa_dpjp', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            {{-- END FORM SKDP --}}

            <div class="form-group row">
                <div class="col-md-12">
                   <label for="catatan">Catatan</label>
                   {!! Form::textarea('catatan', null, array('placeholder' => 'Catatan', 'tabindex' => '1', 'rows' => 2, 'class' => 'form-control form-control-sm'.($errors->has('catatan') ? 'is-invalid' : '') ))!!}
                   {!! $errors->first('catatan', '<span class="invalid-feedback">:message</span>') !!}
               </div>
            </div>
            {{-- FORM KATARAK --}}
            <div id="form-katarak" class="form-group">
                <div class="form-check checkbox">
                    <input class="form-check-input" id="c_katarak" type="checkbox" value="0">
                    <label class="form-check-label" for="c_katarak">Katarak</label>
                </div>
                <input class="form-check-input" id="katarak" name="katarak" type="hidden" value="0">
                <input class="form-control form-control-sm" type="text" placeholder="Centang Katarak, Jika pasien tersebut mendapat surat operasi Katarak" readonly>
            </div>
            {{-- END FORM KATARAK --}}
            <div class="form-group">
                <div class="form-check checkbox">
                    <input class="form-check-input" id="c_penjamin" type="checkbox" value="0">
                    <label class="form-check-label" for="c_penjamin">Penjamin Kll</label>
                </div>
                <input type="hidden" id="lakalantas" name="lakaLantas"  value="0">
                <input type="hidden" id="penjamin" name="penjamin" value="0">
                <input type="hidden" id="suplesi" name="suplesi" value="0">
                <input type="hidden" id="no_suplesi" name="noSepSuplesi" value="0">
            </div>
            {{-- FORM PENJAMIN KLL --}}
            <div id="form-penjamin-kll">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="tgl_kejadian">Tanggal Kejadian</label>
                        {!! Form::text('tglKejadian', null, array('placeholder' => 'Tanggal kejadian', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('tglKejadian') ? 'is-invalid' : '') ))!!}
                        {!! $errors->first('tglKejadian', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                    <div class="col-md-8">
                        <label for="penjamin">Penjamin Kecelakaan</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" name="penjamin[]" id="inline-checkbox1" type="checkbox" value="1">
                                <label class="form-check-label" for="inline-checkbox1">Jasa Raharja</label>
                            </div>
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" name="penjamin[]" id="inline-checkbox2" type="checkbox" value="2">
                                <label class="form-check-label" for="inline-checkbox2">BPJS KetenagaKerjaan</label>
                            </div>
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" name="penjamin[]" id="inline-checkbox3" type="checkbox" value="3">
                                <label class="form-check-label" for="inline-checkbox3">Taspen</label>
                            </div>
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" name="penjamin[]" id="inline-checkbox4" type="checkbox" value="4">
                                <label class="form-check-label" for="inline-checkbox4">ASABRI</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="propinsi">Lokasi Propinsi</label>
                        {!! Form::text('propinsi', null, array('placeholder' => 'Propinsi', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('propinsi') ? 'is-invalid' : '') ))!!}
                        {!! $errors->first('propinsi', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                    <div class="col-md-4">
                        <label for="kota">Lokasi Kota/Kabputen</label>
                        {!! Form::text('kota', null, array('placeholder' => 'Kota', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('kota') ? 'is-invalid' : '') ))!!}
                        {!! $errors->first('kotak', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                    <div class="col-md-4">
                        <label for="kecamatan">Lokasi Kecamatan</label>
                        {!! Form::text('kecamatan', null, array('placeholder' => 'No Telpon', 'tabindex' => '1', 'class' => 'form-control form-control-sm'.($errors->has('no_telpon') ? 'is-invalid' : '') ))!!}
                        {!! $errors->first('no_telp', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, array('placeholder' => 'Keterangan', 'tabindex' => '1', 'rows' => 2, 'class' => 'form-control form-control-sm'.($errors->has('keterangan') ? 'is-invalid' : '') ))!!}
                        {!! $errors->first('keterangan', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                </div>
            </div>
            {{-- END FORM PENJAMIN KLL --}}
            
        </div>
    </div>
</div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>