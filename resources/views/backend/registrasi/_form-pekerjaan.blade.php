<div class="card card-content sembunyi" id="form-pekerjaan">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="kode_pekerjaan">PEKERJAAN</label>
                <select name="kode_pekerjaan" class="select2" id="kode_pekerjaan">
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#prosesModal"><i class="c-icon cil-plus"></i> Proses</button>
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Proses</th>
                            <th>Prioritas</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="button" data-target="#form-client" class="btn btn-outline-info btn-sm move mx-1">Sebelumnya</button>
        <button type="button" data-target="#form-client" class="btn btn-success btn-sm  mx-1">Simpan</button>
        <button type="button" data-target="#form-pembayaran" class="btn btn-primary btn-sm move  mx-1">Selanjutnya</button>
    </div>

</div>
<!-- Modal  -->
<div class="modal fade" id="prosesModal" tabindex="-1" role="dialog" aria-labelledby="prosesLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Proses Pekerjaan</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="proses_pekerjaan_id">Pilih Proses Pekerjaan</label>
                        <select class="form-control" name="proses_pekerjaan" id="proses_pekerjaan_id-key">

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="prioritas">Pilih Prioritas</label>
                        <select class="form-control" name="prioritas" id="prioritas-key">
                            <option disabled>-- Pilih Prioritas --</option>
                            <option value="1">Option1</option>
                            <option value="2">Option2</option>
                            <option value="3">Option3</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input class="form-control" type="text" name="tanggal_mulai">
                    </div>
                    
                    <div class="col-sm-6">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input class="form-control" type="text" name="tanggal_selesai">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Save changes</button>
            </div>
        </div>

    </div>

</div>
<!-- end of modal -->
@push('css')
<link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
<style>
    .select2 {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
        display: table;
        table-layout: fixed;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('lib/select2/js/select2.full.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#kode_pekerjaan').select2({

            placeholder: "Pilih Pekerjaan",
            closeOnSelect: true,
            width: '100%',
            minimumInputLength: 3, // only start searching when the user has input 3 or more characters
            language: {
                inputTooShort: function() {
                    return "Ketik minimal 3 huruf";
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                url: "<?= route('registrasi.cari.pekerjaan') ?>",
                dataType: 'json',
                delay: 100,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_pekerjaan,
                                id: item.kode_pekerjaan
                            }
                        })
                    };
                },
                cache: true
            }
        })
    });
</script>
@endpush