<script>
    $(document).ready(function() {

        $('.move').click(function() {
            if ($($(this).data('validate')).valid()) {
                if ($(this).data('target') == '#card-pembayaran') {
                    if (!($('.del').length)) {
                        showErrorProses();
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
                return false;
            }
        });

    });

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


    function saveData(data) {

        $.ajax({
            url: "<?= route('registrasi.store'); ?>",
            method: "POST",
            data: data,
            dataType: 'json',
            error: function(json) {

                var errors = $.parseJSON(json.responseText);
                $.each(errors.errors, function(key, value) {
                    $('.' + key + '-error').html(value);
                });
            },
            success: function(d) {
                console.log(d);
                if (d.status == 'success') {

                    // return ketika sukses
                } else if ((d.status == 'error')) {

                    // return ketika eror
                }
            }
        });
    }
</script>