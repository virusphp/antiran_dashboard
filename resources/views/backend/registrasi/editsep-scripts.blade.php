<script type="text/javascript">
    $(document).on('click',"#edit-sep", function() {
        var no_reg = $(this).data('reg'),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            },
            method = 'POST',
            url = '/admin/ajax/registrasi/edit/modalsep';

        loadModal()
        $('#create-sep').attr('id','update-sep').val('Update Sep').removeClass('btn-primary').addClass('btn-warning');
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
        $('#modal-sep').removeAttr('style');
    })

    function setDataPasienEdit(data) {
        console.log(data);
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

        if (data.jns_pelayanan == 2) {
            $('#nama-pelayanan b').append('<span>Rawat Jalan</span>')
            $('#poli-tujuan b').append('<span>Poli Tujuan : '+data.nama_sub_unit+'</span>')
        } else {
            $('#nama-pelayanan b').append('<span>Rawat Inap</span>')
            $('#poli-tujuan b').append('<span>Ruang : '+data.nama_sub_unit+'</span>')
        }

        // SELECT 2 DROP DOWN
        getKelas()
        getPeserta()
        getCaraBayar(data.cara_bayar)
        getAsalPasien(data.asal_pasien)
        getInstansi()
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
                console.log(res);
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
                console.log(res);
                setDataSep(res);
            }
        })
    }

    // CHANGE TO API
    function setDataSep(res) {
        $('#no-rujukan').val(res.No_Rujukan)
        $('#tgl-rujukan').val(res.Tgl_Rujukan)
        $('#ppk-rujukan').val(res.Kode_Faskes)
        $('#nama-faskes').val(res.Nama_Faskes)
        $('#kode-diagnosa').val(res.Kd_Diagnosa)
        $('#nama-diagnosa').val(res.Nama_Diagnosa) 
        $('#kode-poli').val(res.Kd_Poli)
        $('#nama-poli').val(res.Nama_Poli)
        $('#no-surat').val(res.no_surat_kontrol)
        $('#no-surat-lama').val(res.no_surat_kontrol)
        $('#kode-dpjp').val(res.kd_dpjp)     
        $('#header-sep').append('<span>'+res.no_SJP+'</span>');
    }

    
</script>