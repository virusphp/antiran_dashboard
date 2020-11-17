<script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('.move').click(function() {
            if ($($(this).data('validate')).valid()) {
                if ($(this).data('target') == '#card-pembayaran') {
                    if (!($('.del').length)) {
                        showErrorProses();
                        warningRequired();
                    } else {
                        $('.card-move').removeClass('bg-info');
                        $($(this).data('target') + '-step').addClass('bg-info');
                        move($(this).data('target'));
                    }
                } else {
                    $('.card-move').removeClass('bg-info');
                    $($(this).data('target') + '-step').addClass('bg-info');
                    move($(this).data('target'));
                }
            } else {
                warningRequired();
                return false;
            }


        });

        $('#card-pekerjaan-step').click(function() {
            if ($('#form-client').valid()) {
                //memindahkan jika valid
                move($(this).data('target'));
                $('.card-move').removeClass('bg-info');
                $($(this).data('target') + '-step').addClass('bg-info');
            } else {
                warningRequired();
                return false;
            }
        });

        $('#card-client-step').click(function() {
            move($(this).data('target'));
            $('.card-move').removeClass('bg-info');
            $($(this).data('target') + '-step').addClass('bg-info');

        });

        $('#card-pembayaran-step').click(function() {
            if ($('#form-pekerjaan').valid() && $('#form-client').valid() && $('.del').length) {
                //memindahkan jika valid
                $('.card-move').removeClass('bg-info');
                $($(this).data('target') + '-step').addClass('bg-info');
                move($(this).data('target'));
            } else {
                warningRequired();
                return false;
            }
        });

    });

    function warningRequired()
    {
        Swal.fire('Mohon Lengkapi Inputan');
    }
    function move(id) {

        $('.card-content').hide(100);
        $('div .move').removeClass('bg-info');
        $(id).show(100);
    }

    function showErrorProses() {
        $('#error-proses').show();
        $('#error-proses-text').text('Proses pekerjaan diperlukan');
    }

    function hideErrorProses() {
        $('#error-proses').hide();
    }

    window.showErrorInput = function showErrorInput(string) {
        $('#errorInputDiv').show();
        $('#errorInput').html(string);
        Swal.fire('Terdapat inputan yang salah!')
    }

    window.hideErrorInput = function hideErrorInput() {

        $('#errorInputDiv').hide();
        $('#errorInput').html("");
    }
    function showLoading(){
        $('#btnSimpanPembayaran').prop("disabled", true);
        $('#btnSimpanPembayaran').html('<span class="spinner-border text-primary spinner-border-sm mx-2" role="status" aria-hidden="true"></span>'
  +'Loading...');
    }
    function hideLoading(){
        $('#btnSimpanPembayaran').prop("disabled", false);
        $('#btnSimpanPembayaran').html('Simpan');
    }

    function kembali()
    {
        return window.location.assign("<?= route('registrasi.index') ?>");
    }
    function saveData(data) {
        hideErrorInput();
        showLoading();
        $.ajax({
            url: "/admin/registrasi",
            method: "POST",
            data: data,
            dataType: 'json',
            error: function(json) {
                var response = $.parseJSON(json.responseText);
                var errorString = '<ul>';
                $.each(response.errors, function(key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';
                hideLoading();
                showErrorInput(errorString);
            },
            success: function(d) {
                console.log(d);
                console.log(d.ok);
                if (d.ok === true) {
                    kembali();
                } else if ((d.ok === 'false')) {
                    hideLoading();
                }
            }
        });
    }
</script>