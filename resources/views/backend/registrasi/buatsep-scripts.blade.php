<script type="text/javascript">
    function loadModal() {
    //     $('#form-skdp').hide();
    //     $('#form-katarak').hide();
    //     $("#form-penjamin-kll").hide();        
    }

    $(document).ready(function() {
        loadModal();
    });

    $(document).on('click',"#buat-sep", function() {
        console.log($(this).data('reg'));
        var no_reg = $(this).data('reg'),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            },
            method = 'POST',
            url = '/admin/ajax/registrasi/modalsep';
        
        $('#modal-sep').modal(options);
        $('#modal-sep').removeAttr('style');
    })
</script>