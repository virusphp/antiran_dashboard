<script type="text/javascript">

    $(document).on('click',"#edit-rujukan", function() { 
        var no_sep = $(this).data('sep'),
            options = {
                'backdrop' : 'static'
            },
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            method = 'POST',
            url = '/admin/ajax/rujukan/edit/modalrujukan';;

        setTypeRujukan()
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
                if (data.code == 200) {
                     // set profil
                    $('#no-sep').val(data.result.no_sep)
                    cariSep(data.result.no_sep)

                    $('#no-sep-rujukan').val(data.result.no_sep)
                    $('#jns-pelayanan option[value='+data.result.jns_pelayanan+']').attr('selected','selected').closest('#jns-pelayanan');
                    $('#m-tgl-rujukan').val(data.result.tgl_rujukan)
                    $('#tipe-rujukan option[value='+data.result.tipe_rujukan+']').attr('selected','selected').closest('#tipe-rujukan');
                    $('#nama-diagnosa').val(data.result.nama_diagnosa)
                    $('#kode-diagnosa').val(data.result.kode)
                    $('#nama-faskes').val(data.result.nama_tujuan_rujukan)
                    $('#ppk-dirujuk').val(data.result.kode_tujukan_rujukan)
                    $('#nama-poli').val(data.result.nama_poli)
                    $('#kode-poli').val(data.result.kode_poli)
                    $('#catatan').val(data.result.catatan)
                } 
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