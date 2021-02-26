<div id="profil-card" class="col-sm-6 col-md-4">
    <div class="card card-accent-dark">
        <div class="card-header"><strong>Profil</strong> Pasien</div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="no_reg">No Registrasi</label>
                    <input class="form-control form-control-sm" id="no-reg" name="no_reg" type="text" placeholder="No Registrassi" readonly>
                    <input class="form-control form-control-sm" name="_token" type="hidden" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-8">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input class="form-control form-control-sm" id="nama-pasien" type="text" placeholder="Nama Pasien" readonly>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-6">
                    <label for="nik">No KTP</label>
                    <input class="form-control form-control-sm" id="no-ktp" type="text" placeholder="No KTP" readonly>
                    {{-- {!! $errors->first('nik', '<span class="invalid-feedback">:message</span>') !!} --}}
                </div>
                <div class="col-md-6">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input class="form-control form-control-sm" id="tgl-lahir" type="text" placeholder="Tanggal Lahir" readonly>
                </div>
            </div>
             <div class="form-group row">
                 <div class="col-md-6">
                    <label for="hak_kelas">Hak Kelas</label>
                    <select id="kelas-rawat" name="kelas_rawat" class="form-control form-control-sm"></select>
                </div>
                <div class="col-md-6">
                    <label for="peserta">Peserta</label>
                    <input class="form-control form-control-sm" id="peserta" type="text" placeholder="Aktif/NON Aktif" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                   <label for="alamat">Alamat</label>
                   <input class="form-control form-control-sm" id="alamat" type="textarea" rows="2" placeholder="Alamat" readonly>
               </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                   <label for="cara_bayar">Cara Bayar</label>
                   <select id="cara-bayar" name="cara_bayar" class="form-control form-control-sm"></select>
               </div>
            </div>
            <div id="form-asal-pasien">
                <div class="form-group row">
                    <div class="col-md-12">
                    <label for="asal_pasien">Asal Pasien</label>
                    <select id="asal-pasien" name="asal_pasien" class="form-control form-control-sm"></select>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_instansi">Nama Instansi</label>
                        <select id="nama-instansi" name="nama_instansi" class="form-control form-control-sm"></select>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>