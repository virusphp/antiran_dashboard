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
                   <input type="text" class="form-control form-control-sm" id="no-kartu" name="no_kartu" placeholder="No Kartu" readonly>
                   <input type="hidden" class="form-control form-control-sm" id="no-sep" name="no_sep" readonly>
                   <input type="hidden" class="form-control form-control-sm" id="tgl-sep" name="tgl_sep" readonly>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-check checkbox">
                            <input class="form-check-input" id="c-cob" type="checkbox" value="0">
                            <label class="form-check-label" for="no_rm">Cob | No RM</label>
                        </div>
                        <input class="form-control form-control-sm" id="no-rm" name="no_rm" type="text" placeholder="No RM" readonly>
                        <input class="form-control form-control-sm" id="cob" name="cob" type="hidden" value="0" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                   <label for="tgl_rujukan">Tanggal Rujukan</label>
                    <div class="form-group mx-2">
                        <div class="controls"> 
                            <div class="input-group date" id="tgl-rujukan-klik" data-target-input="nearest">
                            <input type="text" id="tgl-rujukan" name="tgl_rujukan" class="form-control form-control-sm datetimepicker-input" data-target="#tgl-rujukan-klik"/>
                                <div class="input-group-append" data-target="#tgl-rujukan-klik" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="ci-icon cil-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                 </div>
               </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="no_rujukan">No Rujukan</label>
                    <input class="btn btn-ghost-primary btn-cus" id="cari_rujukan" type="button" value="Pcare">
                    <input class="btn btn-ghost-primary btn-cus" id="cari_rujukan_rs" type="button" value="RS">
                    <input class="btn btn-ghost-primary btn-cus float-right" id="cari_sko" type="button" value="SKO">
                    <input class="form-control form-control-sm" id="no-rujukan" name="no_rujukan" type="text" placeholder="No Rujukan" tabindex="1">
                </div>
                <div class="col-md-4">
                    <label for="asal_rujukan">Asal Rujukan</label>
                    <select id="asal-rujukan" name="asal_rujukan" class="form-control form-control-sm">
                        <option value="1">Faskes Tingkat 1</option> 
                        <option value="2">Faskes Tingkat 2</option> 
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ppk_perujuk">PPK Rujukan / Perujuk</label>
                    <input class="form-control form-control-sm" id="nama-faskes" name="nama_faskes" type="text" placeholder="PPK Asal Rujukan">
                    <input type="hidden" id="ppk-rujukan" name="ppk_rujukan" >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="diagnosa">Diagnosa</label>
                    <input class="form-control form-control-sm" id="nama-diagnosa" name="nama_diagnosa" maxLengh="6" tabindex="2" type="text" placeholder="Diagnosa Awal">
                    <input id="kode-diagnosa" name="kode_diagnosa" type="hidden">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-check checkbox">
                            <input class="form-check-input" id="c-eksekutif" type="checkbox" value="0">
                            <label class="form-check-label" for="poli">Eksekutif | Sep / SubSpelialis</label>
                        </div>
                        <input class="form-control form-control-sm" id="nama-poli" name="nama_poli" type="text" placeholder="Nama Poli">
                        <input id="kode-poli" name="kode_poli" type="hidden" readonly>
                        <input id="eksekutif" name="eksekutif" type="hidden" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="no_telp">No Telp</label>
                    <input class="form-control form-control-sm" id="no-telp" name="no_telp" type="text" tabindex="4" placeholder="No Telp">
                </div>
            </div>

            {{-- FORM SKDP HIDE --}}
            <div id="form-skdp" class="form-group row">
                <div class="col-md-4">
                    <label for="no_surat">No Surat / SKDP</label>
                    <input class="btn btn-ghost-primary btn-cus" id="cari_skdp" type="button" value="cari">
                    <input class="form-control form-control-sm" id="no-surat" name="no_surat" type="text" tabindex="5" placeholder="Ketik no surat kontrol" maxlength="7">
                    <input id="kode-poli-dpjp" type="hidden">
                    <input id="no-surst-lama" name="no_surat_lama" type="hidden">
                </div>
                <div class="col-md-8">
                    <label for="nama_dpjp">DPJP Pemberi Surat / SKDP</label>
                    <select id="nama-dpjp" name="nama_dpjp" class="form-control form-control-sm"></select>
                    <input id="kode-dpjp" name="kode_dpjp" type="hidden">
                </div>
            </div>
            {{-- END FORM SKDP --}}

            <div class="form-group row">
                <div class="col-md-12">
                   <label for="catatan">Catatan</label>
                   <textarea class="form-control form-control-sm" id="catatan" name="catatan" type="text" tabindex="7 "placeholder="Catatan"></textarea>
               </div>
            </div>
            {{-- FORM KATARAK HIDE--}}
            <div id="form-katarak" class="form-group">
                <div class="form-check checkbox">
                    <input class="form-check-input" id="c-katarak" type="checkbox" value="0">
                    <label class="form-check-label" for="katarak">Katarak</label>
                </div>
                <input class="form-check-input" id="katarak" name="katarak" type="hidden" value="0">
                <input class="form-control form-control-sm" type="text" placeholder="Centang Katarak, Jika pasien tersebut mendapat surat operasi Katarak" readonly>
            </div>
            {{-- END FORM KATARAK --}}
            <div class="form-group">
                <div class="form-check checkbox">
                    <input class="form-check-input" id="c-penjamin" type="checkbox" value="0">
                    <label class="form-check-label" for="penjamin">Penjamin Kll</label>
                </div>
                <input type="hidden" id="lakalantas" name="lakalantas"  value="0">
                <input type="hidden" id="penjamin" name="penjamin" value="0">
                <input type="hidden" id="suplesi" name="suplesi" value="0">
                <input type="hidden" id="no_suplesi" name="no_sepsuplesi" value="0">
            </div>
            {{-- FORM PENJAMIN KLL HIDE--}}
            <div id="form-penjamin-kll">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="tgl_kejadian">Tanggal Kejadian</label>
                        <div class="form-group">
                            <div class="controls"> 
                                <div class="input-group date" id="tgl-rujukan-klik" data-target-input="nearest">
                                    <input type="text" id="tgl-rujukan" name="tgl_rujukan" class="form-control form-control-sm datetimepicker-input" data-target="#tgl-rujukan-klik"/>
                                    <div class="input-group-append" data-target="#tgl-rujukan-klik" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="ci-icon cil-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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