<script type="text/javascript">

    $(document).on('click',"#edit-rujukan", function() { 
        var no_sep = $(this).data('sep'),
            options = {
                'backdrop' : 'static'
            },
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            method = 'POST',
            url = '/admin/ajax/rujukan/edit/modalrujukan';;

        getEditRujukan(no_sep, method, url, CSRF_TOKEN)

        $('#modal-rujukan-post').modal(options);
        $('#modal-rujukan-post').removeAttr('style');

    })

    function getEditRujukan(no_sep, method, url, token)
    {
          $.ajax({
            method:method,
            url:url,
            data: {
                _token: token,
                no_sep: no_sep
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
            }
        });
    }

    $('#update-rujukan').click(function() {
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
</script>