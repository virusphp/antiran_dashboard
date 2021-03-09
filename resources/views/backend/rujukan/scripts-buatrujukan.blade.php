<script type="text/javascript">
    $(document).ready(function() {
        loadModal();
    });

    $('#tipe-rujukan').change(function() {
        var type = $(this).val();
        if (type == 0) {
            $('#form-ppk-dirujuk').show();
            $('#form-poli-tujuan').show();
            $('#jenis-faskes').val(2)
        } else if (type == 1) {
            $('#form-ppk-dirujukan').show();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(2)
        } else  {
            $('#form-ppk-dirujukan').hide();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(1)
        }
    })

    $('#modal-rujukan-post').on('hidden.bs.modal', function(){
        var form = $('#form-rujukan-keluar');
        
        $(this).find('form')[0].reset();
    })

    $(document).on('click', '#buat-rujukan', function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        loadModal();
        setTypeRujukan();
        $('#modal-rujukan-post').modal(options);
        $('#modal-rujukan-post').removeAttr('style');
    })

    $('#no-sep').keyup(function() {
        $('#no-sep-rujukan').val($(this).val())
    })

    $('#cari-sep').click(function() {
        var no_sep = $('#no-sep').val();
        cariSep(no_sep)
    })
 

    $('#create-rujukan').click(function() {
        var form_rujukan = $('#form-rujukan-keluar'),
            url = '/admin/ajax/bpjs/insertrujukan',
            method = 'POST';

        $.ajax({
            url:url,
            method:method,
            data: form_rujukan.serialize(),
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                if (data.response !== null) {
                    $('#tabel-message-success').show().html("<span class='text-success' id='success-rujukan'></span>");
                    $('#success-rujukan').html(data.metaData.message+" No rujukan :"+data.response.rujukan.noRujukan).hide()
                        .fadeIn(1500, function() { $('#success-rujukan') });
                    setTimeout(clearMessage, 5000);
                    // sementara load 
                    // ajaxLoad();
                } else {
                    $('#tabel-message-error').show().html("<span class='text-success' id='error-rujukan'></span>");
                    $('#error-rujukan').html(data.metaData.message+ " Silahkan Cek kembali!").hide()
                        .fadeIn(1500, function() { $('#error-rujukan'); });
                    setTimeout(clearMessage, 5000);
                }
                $('#modal-rujukan-post').modal('hide');
            }
        })
    })

    // PRINT SRUJUKAN
    $(document).on('click','#print-rujukan', function() {
        var no_rujukan = $(this).data('rujukan'),
            no_sep = $(this).data('rujukan')
            url = '{{ url("/admin/rujukan/print") }}/'+ no_rujukan;
            var w = window.open(url, "_blank", "width=850, height=600");
        console.log(no_rujukan)
    })
</script>