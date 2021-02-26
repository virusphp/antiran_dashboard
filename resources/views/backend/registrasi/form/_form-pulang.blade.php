<div id="profil-card" class="col-sm-12 col-md-12">
    <div class="card card-accent-dark">
        <div class="card-header"><strong>Pemulangan</strong> Peserta</div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-12">
                   <label for="no_sep_p">No Sep</label>
                   <input class="form-control form-control-sm" id="no-sep-p" name="no_sep_p" type="textarea" rows="2" placeholder="No Sep" readonly>
               </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                   <label for="cara_bayar">Tanggal Pulang</label>
                   <div class="form-group">
                    <div class="controls"> 
                        <div class="input-group date" id="tgl-pulang-klik" data-target-input="nearest">
                        <input type="text" id="tgl-pulang" name="tgl_pulang" class="form-control form-control-sm datetimepicker-input" data-target="#tgl-pulang-klik"/>
                            <div class="input-group-append" data-target="#tgl-pulang-klik" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="ci-icon fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="nama_user">User</label>
                    <input class="form-control form-control-sm" id="user" name="user" type="text" value="{{ Auth::user()->nama_pegawai }}" placeholder="User" readonly>
               </div>
            </div>
            
        </div>
    </div>
</div>