<div class="card card-content sembunyi" id="card-pembayaran">
    <form id="form-pembayaran" class="form-input">
        {{-- untuk mengetahui jika simpan sampai pembayaran --}}
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-12">
                    <h4 class="text-center">FORMULIR PEMBAYARAN </h4>
                    <div class="row">
                        <div class="col-sm-6">
                            Nama Client : <span style="text-transform:uppercase;" id="nama_client-text"></span><br />
                        </div>
                        <div class="col-sm-6 text-right">
                            Pekerjaan : <span id="pekerjaan-text"></span><br />
                            Total Proses Pekerjaan : <span class="font-weight-bold" id="proses-text"></span>
                        </div>
                    </div>
                    <hr style="my-3">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label for="total_biaya_proses">Total Biaya Proses</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Rp
                            </span>
                        </div>
                        <input type="text" class="rupiah form-control" name="total_biaya_proses" placeholder="total biaya proses" id="total_biaya_proses-key" required aria-required="true">
                    </div>
                </div>

                <div class="col-lg-6">
                    <label for="total_biaya_pajak">Total Biaya Pajak</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Rp
                            </span>
                        </div>
                        <input type="text" value="0" class="rupiah form-control" name="total_biaya_pajak" placeholder="total biaya pajak" id="total_biaya_pajak-key">
                    </div>
                    <small class="help-block text-muted">isian biaya pajak dapat diupdate ketika sudah mengetahui biaya pajak</small>
                </div>

            </div>
            <div class="form-group row">
                <div class="col-lg-12 mb-3">
                    <strong>Telah dibayarkan sejumlah</strong><br>
                </div>
                <div class="col-lg-6">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Rp
                            </span>
                        </div>
                        <input type="text" class="form-control rupiah" value="0" name="jumlah_bayar" placeholder="total bayar" id="jumlah_bayar-key" required aria-required="true">
                    </div>

                </div>

                <div class="col-sm-6">
                    <label for="no_referensi">Nomor Referensi Kwitansi</label>
                    <input type="text" class="form-control" name="no_referensi" id="no_referensi-key">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan-key" rows="2" required aria-required="true"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" data-validate="#form-pembayaran" data-target="#card-pekerjaan" class="btn btn-outline-info btn-sm move mx-1">Sebelumnya</button>
            <button type="button" id="btnSimpanPembayaran" class="btn btn-success btn-sm  mx-1">Simpan</button>
        </div>
    </form>
</div>

@push('scripts')
<script src="{{ asset('lib\jquery.mask\jquery.mask.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $("#form-pekerjaan").validate({
            rules: {
                jumlah_bayar: {
                    required: true,
                },
                no_referensi: {
                    required: function(element) {
                        return $("#jumlah_bayar-key").val() > 0;
                    }
                }
            }
        });

        $('#btnSimpanPembayaran').click(function(e) {
            e.preventDefault();
            if ($('#form-pekerjaan').valid() && $('#form-client').valid() && $('#form-pembayaran').valid()) {
                if (!($('.del').length)) {
                    showErrorProses();
                } else {
                    //save full sampai pembayaran
                    var data = $('#form-client, #form-pekerjaan,#form-pembayaran').serialize();
                    saveData(data);
                }
            } else {
                //todo msg warning lengkapi isian
            }

        });

        $('.rupiah').mask('000.000.000.000.000', {
            reverse: true
        });

    });
</script>
@endpush