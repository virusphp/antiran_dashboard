<script>
    $(document).ready(function() {

        $('.move').click(function() {
            if ($($(this).data('validate')).valid()) {
                $('.card-move').removeClass('bg-info');
                $($(this).data('target') + '-step').addClass('bg-info');
                move($(this).data('target'));
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

        $('#card-tagihan-step').click(function() {
            if ($('#form-pekerjaan').valid()) {
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
</script>