<div class="card card-content sembunyi" id="card-pekerjaan">
    <form id="form-pekerjaan" class="form-input">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="kode_pekerjaan-key">PEKERJAAN</label>
                    <select name="kode_pekerjaan" class="select2" id="kode_pekerjaan-key" required aria-required="true">
                    </select>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-sm-6">
                    <label for="no_akta-key">NOMOR AKTA</label>
                    <input class="form-control" type="text" placeholder="NOMOR AKTA" name="no_akta" id="no_akta-key" required aria-required="true">
                </div>

                <div class="col-sm-6">
                    <label for="lokasi_akta-key">LOKASI AKTA</label>
                    <input class="form-control" type="text" placeholder="LOKASI AKTA" name="lokasi_akta" id="lokasi_akta-key" required aria-required="true">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button id="createProses" class="btn btn-primary mb-3 float-right" type="button"><i class="c-icon cil-plus"></i> Proses</button>
                    <div class="card bg-danger" style="display:none;" id="error-proses">
                        <div class="text-light text-center" id="error-proses-text">

                        </div>
                    </div>
                    <table class="table table-responsive-sm table-bordered">
                        <thead id="thead">
                            <tr>
                                <th>Nama Proses</th>
                                <th>Prioritas</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" data-validate="#form-pekerjaan" data-target="#card-client" class="btn btn-outline-info btn-sm move mx-1">Sebelumnya</button>
            <button type="button" data-validate="#form-pekerjaan" data-target="#card-pembayaran" class="btn btn-primary btn-sm move  mx-1">Selanjutnya</button>
        </div>
    </form>
</div>

<!-- Modal  -->
<div class="modal fade" id="prosesModal" role="dialog" style="display: none;" aria-modal="true">

    <div class="modal-dialog modal-lg" role="document">
        <form id="prosesModalForm" class="form-input">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Proses Pekerjaan</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="kode_proses-key">Pilih Proses Pekerjaan</label>
                            <select class="form-control" name="kode_proses" id="kode_proses-key" required aria-required="true">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="prioritas-key">Pilih Prioritas</label>
                            <select class="form-control" name="prioritas" id="prioritas-key" required aria-required="true">
                                <option disabled selected>-- Pilih Prioritas --</option>
                                <option value="SESUAI">Sesuai</option>
                                <option value="SEGERA">Segera</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="tanggal_mulai-key">Tanggal Mulai</label>
                            <input class="date-input form-control" type="text" name="tanggal_mulai" id="tanggal_mulai-key" required aria-required="true">
                        </div>

                        <div class="col-sm-6">
                            <label for="tanggal_selesai-key">Tanggal Selesai</label>
                            <input class="date-input form-control" type="text" name="tanggal_selesai" id="tanggal_selesai-key" required aria-required="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btnModalTambah" type="button">Tambahkan</button>
                </div>
            </div>
        </form>
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
<script src="{{ asset('lib/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('lib/jquery-validation/localization/messages_id.js') }}"></script>
<script src="{{ asset('lib/datedropper/datedropper.pro.min.js') }}"></script>
<script>
    var validate = $(".form-input").validate({

        errorClass: "text-danger",
        errorElement: "small",
        lang: 'id', // or whatever language option you have.
        errorPlacement: function(error, element) {
            if (element.parent().hasClass('form-group')) {
                error.insertAfter(element.parent());
            } else if (element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element);
            }
        },
    });

    $(document).ready(function() {

        // $('#btnSimpanPekerjaan').click(function(e) {
        //     e.preventDefault();
        //     if ($('#form-pekerjaan').valid() && $('#form-client').valid()) {
        //         if (!($('.del').length)) {
        //             showErrorProses();
        //         } else {
        //             //save hanya client dan pekerjaan
        //             var data = $('#form-client, #form-pekerjaan').serialize();
        //             saveData(data);
        //         }
        //     } else {
        //         //todo msg warning lengkapi isian
        //     }

        // });
        

        $('#btnModalTambah').click(function() {
            if ($('#prosesModalForm').valid()) {
                tambahProses();
                $('#prosesModal').modal('hide');
            } else {
                return false;
            }
        });

        $('#prosesModal').on('hidden.coreui.modal', function() {
            resetModalForm();
        });

        $('#createProses').click(function() {
            $('#prosesModal').modal('show');
        });

        $('#tbody').on('click', '.del', function() {
            var id = parseInt($(this).val());
            $('#item_' + id).remove();
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

    function tambahProses() {

        var $kode_proses = $('#kode_proses-key'),
            $prioritas = $('#prioritas-key'),
            $tanggal_mulai = $('#tanggal_mulai-key'),
            $tanggal_selesai = $('#tanggal_selesai-key'),
            tr_id = parseInt(($('#tbody tr').length == 0) ? 0 : $('#tbody tr').length),
            trOpen = '<tr id="item_' + tr_id + '">',
            td1 = '<td class="input">' + $kode_proses.select2("data")[0].text + ' <input type="hidden" name="details[' + tr_id + '][kode_proses]" value="' + $kode_proses.select2("data")[0].id + '"></td>',
            td2 = '<td class="input text-center">' + $prioritas.val() + '<input type="hidden" name="details[' + tr_id + '][prioritas]" value="' + $prioritas.val() + '"></td>',
            td3 = '<td class="input text-center">' + $tanggal_mulai.val() + '<input type="hidden" name="details[' + tr_id + '][tanggal_mulai]" value="' + $tanggal_mulai.val() + '"></td>',
            td4 = '<td class="input text-center">' + $tanggal_selesai.val() + '<input type="hidden" name="details[' + tr_id + '][tanggal_selesai]" value="' + $tanggal_selesai.val() + '"></td>',
            td5 = '<td class="text-center"> <button class="btn btn-danger del" type="button" value="' + tr_id + '">Hapus</button></td>',
            trClose = '</tr>',
            result_tr = trOpen + td1 + td2 + td3 + td4 + td5 + trClose;
        $('#tbody').append(result_tr);

        $('#proses-text').html($('.del').length);
        $('#error-proses').hide();
    }

    function resetModalForm() {
        $('#prosesModal form')[0].reset();
        $("#prosesModalForm").validate().resetForm();
        $('#kode_proses-key').val("").trigger('change');
    }
    window.setPekerjaan = function setPekerjaan(textPekerjaan) {
        $('#pekerjaan-text').html(textPekerjaan);
    }
</script>
@endpush