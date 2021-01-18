<div id="biodata-card" class="col-sm-6 col-md-8">
    <div class="card card-accent-dark">
        <div class="card-header">
            <strong>Pembuatan Rujukan</strong> 
            <small id="nama-pelayanan"><b></b></small>
            <small class="float-right" id="poli-tujuan"><b></b></small>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="no_sep_rujukan">No Sep</label>
                        <input id="no-sep-rujukan" name="no_sep_rujukan" type="text" class="form-control form-control-sm" placeholder="No Sep" readonly> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jns-pelayanan">Jenis Palayanan</label>
                        <select id="jns-pelayanan" name="jns_pelayanan" class="form-control form-control-sm">
                            <option value="1">Rawat Inap</option> 
                            <option value="2">Rawat Jalan</option> 
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                   <label for="tgl_pendaftaran">Tanggal Rujukan</label>
                    <div class="form-group mx-2">
                        <div class="controls"> 
                            <div class="input-group date" id="tgl-rujukan-klik" data-target-input="nearest">
                                <input type="text" id="m-tgl-rujukan" name="tgl_rujukan" class="form-control form-control-sm datetimepicker-input" data-target="#tgl-rujukan-klik"/>
                                <div class="input-group-append" data-target="#tgl-rujukan-klik" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="ci-icon fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                 </div>
               </div>
            </div>
             {{-- FORM TIPE RUJUKAN --}}
             <div id="form-skdp" class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tipe-rujukan">Tipe Rujukan</label>
                        <select id="tipe-rujukan" name="tipe_rujukan" class="form-control form-control-sm">
                            <option value="0">Rujukan Penuh</option> 
                            <option value="1">Rujukan Partial</option> 
                            <option value="2">Rujukan Balik</option> 
                        </select>
                    </div>
                </div>
            </div>

            {{-- Kelompok diagnosa poli --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="diagnosa">Diagnosa Rujukan</label>
                        <input class="form-control form-control-sm" id="nama-diagnosa" name="nama_diagnosa" maxLengh="6" tabindex="2" type="text" placeholder="Diagnosa Awal">
                        <input id="kode-diagnosa" name="kode_diagnosa" type="hidden">
                    </div>
                </div>
                <div id="form-ppk-dirujuk" class="col-md-4">
                    <div class="form-group">
                        <label for="ppk_dirujuk">Di Rujuk Ke</label>
                        <input class="form-control form-control-sm" id="nama-faskes" name="nama_faskes" type="text" placeholder="PPK Asal Rujukan">
                        <input type="hidden" id="jenis-faskes" value="0">
                        <input type="hidden" id="ppk-dirujuk" name="ppk_dirujuk">
                    </div>
                </div>
                <div id="form-poli-tujuan" class="col-md-4">
                    <div class="form-group">
                        <label class="form-check-label" for="poli">Poli Tujuan Supspesialis</label>
                        <input class="form-control form-control-sm" id="nama-poli" name="nama_poli" type="text" placeholder="Nama Poli">
                        <input id="kode-poli" name="kode_poli" type="hidden" readonly>
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