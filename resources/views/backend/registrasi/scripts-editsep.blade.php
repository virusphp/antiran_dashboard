<script type="text/javascript">
    $(document).on('click',"#edit-sep", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var no_reg = $(this).data('reg'),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            },
            method = 'POST',
            url = '/admin/ajax/registrasi/edit/modalsep';

        $('#create-sep').attr('id','update-sep').val('Update Sep').removeClass('btn-primary').addClass('btn-warning');
        loadModal()
        $.ajax({
            method:method,
            url:url,
            data: {
                _token: CSRF_TOKEN,
                no_reg: no_reg
            },
            dataType: "json",
            success: function(data) {
                setDataPasienEdit(data);
                getProvinsi();
            }
        });
        $('#modal-sep').modal(options);
    })

    function setDataPasienEdit(data) {
        // console.log(data);
        $('#no-reg').val(data.no_reg)
        $('#no-rm').val(data.no_rm)
        $('#no-kartu').val(data.no_kartu)
        $('#no-telp').val(data.no_telp)
        $('#nama-pasien').val(data.nama_pasien)
        $('#no-ktp').val(data.nik)
        $('#tgl-lahir').val(moment(data.tgl_lahir, "DD-MM-YYYY").format('DD-MMMM-YYYY'))
        $('#alamat').val(data.alamat)
        $('#jns-pelayanan').val(data.jns_pelayanan)
        $('#tgl-reg').val(data.tgl_sep)
        $('#tgl-sep').val(data.tgl_sep)
        $('#no-sep').val(data.no_sep)
        $('#header-sep').append('<span>'+data.no_sep+'</span>');

        if (data.jns_pelayanan == 2) {
            $('#nama-pelayanan b').append('<span>Rawat Jalan</span>')
            $('#poli-tujuan b').append('<span>Poli Tujuan : '+data.nama_sub_unit+'</span>')
            $('#form-asal-pasien').show()
            getAsalPasien(data.asal_pasien)
            getInstansi(data.kd_instansi)
        } else {
            $('#nama-pelayanan b').append('<span>Rawat Inap</span>')
            $('#poli-tujuan b').append('<span>Ruang : '+data.nama_sub_unit+'</span>')
        }

        showDokterDPJP()
        // SELECT 2 DROP DOWN
        getKelas()
        getPeserta()
        getCaraBayar(data.cara_bayar)
        getDataSep(data.no_sep, data.no_reg)
        showCatatan(data.no_sep)
    }

    function showCatatan(no_sep) {
        var url = '/admin/ajax/bpjs/carisep',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url:url,
            method:method,
            dataType: "JSON",
            data: {
                no_sep: no_sep
            },
            success: function(res) {
                // console.log(res);
                $('#catatan').val(res.response.catatan);
            }
        })
    }

    function getDataSep(no_sep, no_reg) {
        var url = '/admin/ajax/sep/editsep',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if (no_sep.length < 1) return;
        $.ajax({
            url:url,
            method:method,
            data: {
                no_reg: no_reg,
                no_sep: no_sep
            },
            success: function(res) {
                setDataSep(res);
            }
        })
    }

    // CHANGE TO API
    function setDataSep(res) {
        if (res.no_SJP) {
            $('#header-sep span').remove();
            $('#no-rujukan').val(res.No_Rujukan)
            $('#tgl-rujukan').val(res.Tgl_Rujukan)
            $('#ppk-rujukan').val(res.Kd_Faskes)
            $('#nama-faskes').val(res.Nama_Faskes)
            $('#kode-diagnosa').val(res.Kd_Diagnosa)
            $('#nama-diagnosa').val(res.Nama_Diagnosa) 
            $('#kode-poli').val(res.Kd_Poli)
            $('#nama-poli').val(res.Nama_Poli)
            $('#asal-rujukan option[value='+res.Asal_Faskes+']').attr('selected','selected').closest('#asal-rujukan');
            $('#header-sep').append('<span>'+res.no_SJP+'</span>');

            if (res.no_surat_kontrol != "000000") {
                $('#form-skdp').show()
                $('#no-surat').val(res.no_surat_kontrol)
                $('#no-surat-lama').val(res.no_surat_kontrol)
                $('#nama-dpjp option[value='+res.kd_dpjp+']').attr('selected', 'selected').closest('#nama-dpjp');
                $('#kode-dpjp').val(res.kd_dpjp)     
                $('#nama-dpjp').val(res.kd_dpjp)
                $('#nama-dpjp').select2().trigger('change')

            }
        }
    }

    $(document).on('click', '#update-sep', function() {
        var form_sep = $('#form-sep'),
            url = '/admin/ajax/bpjs/updatesep',
            method = 'PUT';
            // console.log(url, method)
        form_sep.find('#asal-rujukan').prop('disabled', false)
        form_sep.find('#kelas-rawat').prop('disabled', false);

        $.ajax({
            url:url,
            method:method,
            data: form_sep.serialize(),
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if (data.response !== null) {
                    $('#tabel-message-success').show().html("<span class='text-success' id='success-sep'></span>");
                    $('#success-sep').html(data.metaData.message+" Update No Sep :"+data.response).hide()
                        .fadeIn(1500, function() { $('#success-sep') });
                    setTimeout(clearMessage, 5000);
                    // sementara load 
                    ajaxLoad();
                } else {
                    $('#tabel-message-error').show().html("<span class='text-success' id='error-sep'></span>");
                    $('#error-sep').html(data.metaData.message+ " Silahkan Cek kembali!").hide()
                        .fadeIn(1500, function() { $('#error-sep'); });
                    setTimeout(clearMessage, 5000);
                }
                $('#modal-sep').modal('hide');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON
                $.each(errors.errors, function(key, value) {
                    $("[name='"+key+"']").addClass('is-invalid')
                                .closest('.form-group')
                                .append('<span class="invalid-feedback"><strong>' +value[0]+ '</strong></span>');
                    $("[name='"+key.replace("kode","nama")+"']").addClass('is-invalid')
                                .closest('.form-group');
                     $("[id='"+key.replace("ppk_","nama-")+"']").addClass('is-invalid')
                                .closest('.form-group');

                })
            }
        })
    })
</script>