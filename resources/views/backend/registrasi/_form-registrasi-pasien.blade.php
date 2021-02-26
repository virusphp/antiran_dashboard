<div id="registrasi-card" class="col-sm-6 col-md-8">
    <div class="card card-accent-dark">
        <div class="card-header">
            <strong>Pendaftaran Pasien Rawat Jalan</strong> 
            <small id="nama-pelayanan"><b></b></small>
            <small class="float-right" id="poli-tujuan"><b></b></small>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-no-registrasi">No Registrasi</label>
                        <input id="r-no-registrasi" name="r_no_registrasi" type="text" class="form-control form-control-sm" placeholder="No Registrasi" readonly> 
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_pendaftaran">Tanggal Registrasi</label>
                        <div class="form-group mx-1 my-n1">
                            <div class="controls"> 
                                <div class="input-group date" id="r-tgl-registrasi-klik" data-target-input="nearest">
                                    <input type="text" id="m-tgl-registrasi" name="tgl_registrasi" class="form-control form-control-sm datetimepicker-input" data-target="#tgl-rujukan-klik"/>
                                    <div class="input-group-append" data-target="#tgl-registrasi-klik" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="ci-icon fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jam_pendaftaran">Jam Registrasi</label>
                        <input id="r-jam-registrasi" name="r_jam_registrasi" value="{{ date('H:i:s') }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
           
            {{-- POLI TARIF DAN DOKTER --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kode_poli">Tujuan Klinik</label>
                        <select id="r-kode-poli" name="r_kode_poli" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r_tarif">Tarif Klinik</label>
                        <input class="form-control form-control-sm" id="r-tarif-klinik" name="r_tarif_klinik" type="text" placeholder="Tarif Klinik">
                        <input type="hidden" id="r-kode-tarif" value="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-check-label" for="r-kode-dokter">Dokter Klinik</label>
                        <select id="r-kode-dokter" name="r_kode_dokter" class="form-control form-control-sm"></select>
                    </div>
                </div>
            </div>

             {{-- CARA BAYAR DAN PENJAMIN --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-cara-bayar">Cara Bayar</label>
                        <select id="r-cara-bayar" name="r_cara_bayar" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-kode-penjamin">Penjamin</label>
                        <select id="r-kode-penjamin" name="r_kode_penjamin" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-no-kartu">No Kartu</label>
                        <input id="r-no-kartu" name="r_no_kartu" class="form-control form-control-sm">
                    </div>
                </div>
            </div>

              {{-- Hak Kelas dan status --}}
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-hak-kelas">Hak Kelas</label>
                        <input id="r-hak-kelas" name="r_hak_kelas" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-status-aktif">Status AKtif</label>
                        <input id="r-status-aktif" name="r_status_aktif" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>

            {{-- CARA MASUk dan INSTANSI --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-cara-masuk">Cara Masuk</label>
                        <select id="r-cara-masuk" name="r_cara_masuk" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-check-label" for="r-kode-instansi">Nama Instansi</label>
                        <select id="r-kode-instansi" name="r_kode_instansi" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="r-no-rujukan">No Rujukan</label>
                        <input id="r-no-rujukan" name="r_no_rujukan" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            
            <div class="form-group ">
                <label for="catatan">Catatan</label>
                <textarea class="form-control form-control-sm" id="catatan" name="catatan" type="text" tabindex="7 "placeholder="Catatan"></textarea>
            </div>
        </div>
    </div>
</div>