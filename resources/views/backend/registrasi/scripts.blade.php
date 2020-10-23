<script>
    $(document).ready(function() {

        $('.move').click(function() {
            move($(this).data('target'));
            //menambahkan step menjadi aktif
            $($(this).data('target') + '-step').addClass('bg-info');
        });
    });

    function move(id) {

        $('.card-content').hide(100);
        $('div .move').removeClass('bg-info');
        $(id).show(100);

    }
</script>