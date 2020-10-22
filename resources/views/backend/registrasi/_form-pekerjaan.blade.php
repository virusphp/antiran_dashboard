<div class="card card-content sembunyi" id="form-pekerjaan">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="kode_pekerjaan-key">PEKERJAAN</label>
                <select name="kode_pekerjaan" class="select2" id="kode_pekerjaan-key">
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button id="createProses" class="btn btn-primary mb-3 float-right" type="button"><i class="c-icon cil-plus"></i> Proses</button>

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
        <button type="button" data-target="#form-tagihan" class="btn btn-primary btn-sm move  mx-1">Selanjutnya</button>
    </div>

</div>

<!-- Modal  -->
<div class="modal fade" id="prosesModal" role="dialog" style="display: none;" aria-modal="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Proses Pekerjaan</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="kode_proses-key">Pilih Proses Pekerjaan</label>
                        <select class="form-control" name="kode_proses" id="kode_proses-key">

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="prioritas-key">Pilih Prioritas</label>
                        <select class="form-control" name="prioritas" id="prioritas-key">
                            <option disabled selected>-- Pilih Prioritas --</option>
                            <option value="SESUAI">Sesuai</option>
                            <option value="SEGERA">Segera</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="tanggal_mulai-key">Tanggal Mulai</label>
                        <input class="date-input form-control" type="text" name="tanggal_mulai" id="tanggal_mulai-key">
                    </div>

                    <div class="col-sm-6">
                        <label for="tanggal_selesai-key">Tanggal Selesai</label>
                        <input class="date-input form-control" type="text" name="tanggal_selesai-key">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
                <button class="btn btn-primary" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->
@push('css')
<link rel="stylesheet" href="{{ asset('lib/datedropper/standart.css') }}">
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
<script src="{{ asset('lib/datedropper/datedropper.pro.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#prosesModal').on('hidden.coreui.modal', function() {
            //todo reset modal
        });

        $('#createProses').click(function() {
            $('#prosesModal').modal('show');
        });

        $('.date-input').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y',
            modal: true,
            largeDefault: true,
            largeOnly: true,
            minYear: 2020,
            autofill: false
        });
        $('#kode_proses-key').select2({

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
                url: "<?= route('registrasi.cari.proses') ?>",
                dataType: 'json',
                delay: 100,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_proses,
                                id: item.kode_proses
                            }
                        })
                    };
                },
                cache: true
            }
        });



        $('#kode_pekerjaan-key').select2({

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
        }).on('change', function() {
            setPekerjaan($(this).select2('data')[0].text);
        });
    });

    window.setPekerjaan = function setPekerjaan(textPekerjaan) {
        $('#pekerjaan-text').html(textPekerjaan);
    }
</script>
@endpush