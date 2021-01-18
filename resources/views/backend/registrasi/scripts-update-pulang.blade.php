<script type="text/javascript">

   

    $('#cari-history').on('click', function() {
        var no_rm = $('#no-rm-history').val(),
            tgl_akhir = moment().format("YYYY-MM-DD"),
            url = '/admin/ajax/bpjs/history/peserta',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if (no_rm.length < 6) {
            alert("NO RM Kurang dari 6 Digit!!!!");
           return false;
        }

        getHistoryPeserta(no_rm, tgl_akhir, url, method, CSRF_TOKEN)
   })

   function getHistoryPeserta(no_rm, tgl_akhir, url, method, _token) {
        var options = {
                'backdrop': 'static'
            };
        $.ajax({
            url:url,
            method:method,
            data: {no_rm:no_rm, tgl_akhir: tgl_akhir, _token: _token},
            dataType: "JSON",
            success: function(response) {
                console.log(response)
                if (response.metaData.code == 200) {
                    // console.log("masuk sini")
                    $('#x-no-rm').append('<strong><p id="v-no-rm">'+response.response.noRm+'</p></strong>')
                    $('#x-nama-peserta').append('<strong><p id="v-nama-peserta">'+response.response.namaPeserta+'</p></strong>')
                    $('#x-no-kartu').append('<strong><p id="v-no-kartu">'+response.response.noKartu+'</p></strong>')
                    var history = '';
                    $.each(response.response.histori, function(key, val){
                        history += '<tr>';
                        history += '<td><div class="btn-group"><button data-sep="'+val.noSep+'" id="h-sep-p" class="btn btn-sencodary btn-xs btn-cus">'+ val.noSep +'</button></div></td>';
                        history += '<td>'+val.tglSep+'</td>';
                        history += '<td>'+val.tglPlgSep+'</td>';
                        history += '<td>'+((val.jnsPelayanan == 2) ? 'R Jalan' : 'R Inap')+'</td>';
                        history += '<td>'+val.poli+'</td>';
                        history += '<td>'+val.noRujukan+'</td>';
                        history += '<td>'+val.ppkPelayanan+'</td>';
                        history += '</tr>';
                    });
                    $('#tabel-history-peserta tbody').append(history);
                } 
                $('#modal-history').modal(options)
            },
        })
    }

    $(document).on('click', '#h-sep-p',function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            noSep = $(this).data('sep'),
            options = {
                'backdrop' : 'static'
            }; 
            console.log(noSep)
            $('#no-sep-p').val(noSep)
            $('#modal-pulang').modal(options)
            $('#modal-history').modal('hide')
    })

    $('#update-pulang').on('click', function() {
        var form = $('#form-update-pulang'),
            url = "/admin/ajax/bpjs/sep/pulang",
            method = "POST";
        
        $.ajax({
            url:url,
            method:method,
            data: form.serialize(),
            dataType: "JSON",
            success: function(result) {
                console.log(result)
                if (result.metaData.code == 200) {
                    $('#tabel-message-success').show().html("<span class='text-success' id='success-sep'></span>");
                    $('#success-sep').html(result.metaData.message+" No Sep :"+result.response).hide()
                        .fadeIn(1500, function() { $('#success-sep') });
                    setTimeout(clearMessage, 5000);
                    // sementara load 
                    ajaxLoad();
                } else {
                    $('#tabel-message-error').show().html("<span class='text-success' id='error-sep'></span>");
                    $('#error-sep').html(result.metaData.message+ "Silahkan Cek kembali!").hide()
                        .fadeIn(1500, function() { $('#error-sep'); });
                    setTimeout(clearMessage, 5000);
                }
                $('#modal-pulang').modal('hide');
            }
        })
    })

</script>