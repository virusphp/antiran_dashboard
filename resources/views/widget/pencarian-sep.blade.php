<div class="d-flex float-right">
    <div class="form-group my-2 mx-2">
        <div class="controls">
            <div class="input-group">
                <div class="col-md-12 col-form-label form-inline">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" type="radio" id="jns_rawat1" value="1" name="jns_rawat" checked>
                        <label class="form-check-label" for="jns_rawat1">Rawat Jalan</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" type="radio" id="jns_rawat2" value="2" name="jns_rawat">
                        <label class="form-check-label" for="jns_rawat2">Rawat Inap</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" type="radio" id="jns_rawat3" value="3" name="jns_rawat">
                        <label class="form-check-label" for="jns_rawat3">IGD</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group my-2 mx-2">
        <div class="controls">
            <div class="input-group">
                <select id="carabayar" class="form-control form-control-sm"></select>
            </div>
        </div>
    </div>
    <div class="form-group my-2 mx-2">
       <div class="controls"> 
            <div class="input-group date" id="tanggal_reg" data-target-input="nearest">
            <input type="text" id="tgl_reg" name="tgl_reg" class="form-control form-control-sm datetimepicker-input" data-target="#tanggal_reg"/>
                <div class="input-group-append" data-target="#tanggal_reg" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="ci-icon fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group my-2 mx-2">
        <div class="controls">
            <div class="input-group">
                <input class="form-control form-control-sm" name="term" id="term" size="16" type="text">
                <span class="input-group-append">
                    <button id="cari-button" class="btn btn-sm btn-secondary" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
</div>