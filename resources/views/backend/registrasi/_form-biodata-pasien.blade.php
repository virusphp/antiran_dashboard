<div id="profil-card" class="col-sm-6 col-md-4">
    <div class="card card-accent-dark">
        <div class="card-header"><strong>Profil</strong> Pasien</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="controls">
                        <label for="no_rekamedik">No Rekamedik</label>
                        <div class="input-group">
                            <input class="form-control form-control-sm" name="r_no_rm" id="r-no-rm" type="text">
                            <span class="input-group-append">
                                <button id="cari-rm" class="btn btn-sm btn-success" type="button">Cari!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input class="form-control form-control-sm" id="r-nama-pasien" type="text" placeholder="Nama Pasien" readonly>
               </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-6">
                    <label for="tempat-lahir">Tempat Lahir</label>
                    <input class="form-control form-control-sm" id="r-tanggal-lahir" type="text" placeholder="Tanggal Lahir" readonly>
                </div>
                <div class="col-md-6">
                    <label for="tanggal-lahir">Tanggal Lahir</label>
                    <input class="form-control form-control-sm" id="r-tanggal-lahir" type="text" placeholder="Tanggal Lahir" readonly>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-6">
                    <label for="jns-kelamin">Jenis Kelamin</label>
                    <input class="form-control form-control-sm" id="r-jns-kelamin" type="text" placeholder="Jenis Kelamin" readonly>
                </div>
                <div class="col-md-6">
                    <label for="no-telp">No Telp</label>
                    <input class="form-control form-control-sm" id="r-no-telp" type="text" placeholder="No Telp" readonly>
                </div>
            </div>

             <div class="form-group row">
                 <div class="col-md-12">
                    <label for="alamat-pasien">Alamat Pasien</label>
                    <textarea id="r-alamat-pasien" class="form-control form-control-sm" type="textarea" rows="4" placeholder="Alamat" readonly></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
