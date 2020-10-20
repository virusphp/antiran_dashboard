<div class="card card-content sembunyi" id="form-pekerjaan">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="kode_pekerjaan">PEKERJAAN</label>
                <select name="kode_pekerjaan" class="select2" id="kode_pekerjaan">
                </select>
            </div>
        </div>
    </div>
</div>


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