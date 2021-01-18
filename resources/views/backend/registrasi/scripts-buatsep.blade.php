<script type="text/javascript">
    $(document).ready(function() {
        loadModal();
    });

    $(document).on('click',"#buat-sep", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var no_reg = $(this).data('reg'),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            },
            method = 'POST',
            url = '/admin/ajax/registrasi/modalsep';

        $('#update-sep').attr('id','create-sep').val('Create Sep').removeClass('btn-primary').addClass('btn-warning');
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
                setDataPasien(data);
                getProvinsi();
            }
        });
        $('#modal-sep').modal(options);
        $('#modal-sep').removeAttr('style');
    })

    // SET DATA KE MODAL
    function setDataPasien(data) {
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
        $('#tgl-rujukan').val(data.tgl_sep)
        $('#no-sep').val(data.no_sjp)

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

        // SELECT 2 DROP DOWN
        getKelas()
        getPeserta()
        getCaraBayar(data.cara_bayar)
    }

    $('#cari-rujukan').on('click', function() {
        var no_kartu = $('#no-kartu').val(),
            url = '/admin/ajax/bpjs/list/rujukan',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        getListRujukan(no_kartu, url, method, CSRF_TOKEN);

        $('#modal-rujukan').modal(options)
    });

    $('#cari-rujukan-rs').on('click', function() {
        var no_kartu = $('#no-kartu').val(),
            url = '/admin/ajax/bpjs/list/rujukanrs',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        getListRujukan(no_kartu, url, method, CSRF_TOKEN);

        $('#modal-rujukan').modal(options)
    })

    $(document).on('click', '#cari-sko', function() {
        var no_kartu = $('#no-kartu').val(),
            url = '/admin/ajax/bpjs/list/sep',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            tgl_akhir = moment().format("YYYY-MM-DD"),
            options = {
                'backdrop' : 'static'
            };

        getListSko(no_kartu, url, method, CSRF_TOKEN, tgl_akhir);

        $('#modal-rujukan').modal(options);
    })

    $(document).on('click', '#cari-skdp', function() {
        var no_rujukan = $('#no-rujukan').val(),
            url = '/admin/ajax/list/skdp',
            method = 'post',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        getListNoSurat(no_rujukan, url, method, CSRF_TOKEN);

        $('#modal-skdp').modal(options);
    })

    function getListNoSurat(no_rujukan, url, method, CSRF_TOKEN)
    {
        $('#tabel-skdp').dataTable({
            "autoWidth"     : false,
            "Processing"    : true,
            "ServerSide"    : true,
            "sDom"          : "<t <'float-right' i><p >>",
            "iDisplayLength": 25,
            "bDestroy"      : true,
            "oLanguage"     : {
                "sLengthMenu"    : "_MENU_ ",
                "sInfo"          : "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                "sSearch"        : "Search Data: ",
                "sZeroRecords"   : "Tidak ada data",
                "sEmptyTable"    : "Data tidak tersedia",
                "sLoadingRecords": '<img src   = "{{ asset('ajax-loader.gif') }}"> Loading...'
            },           
            "ajax": {
                "url" : url,
                "type": method,
                "data": {
                    "no_rujukan": no_rujukan,
                    "_token" : CSRF_TOKEN
                }
            },
            "columns": [
                {"mData": "no"},
                {"mData": "no_surat"},
                {"mData": "jns_surat"},
                {"mData": "kd_poli_dpjp"},
                {"mData": "no_rujukan"},
                {"mData": "nama_dokter"}
            ]
        })
        oTable = $('#tabel-skdp').DataTable();  
        $('#no_rujukan').keyup(function(){
            oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        }); 
    }

    function getListSko(no_kartu, url, method, CSRF_TOKEN, tgl_akhir) {
        $('#tabel-rujukan').dataTable({
            "autoWidth"     : false,
            "Processing"    : true,
            "ServerSide"    : true,
            "sDom"          : "<t <'float-right' i><p >>",
            "iDisplayLength": 25,
            "bDestroy"      : true,
            "oLanguage"     : {
                "sLengthMenu"    : "_MENU_ ",
                "sInfo"          : "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                "sSearch"        : "Search Data: ",
                "sZeroRecords"   : "Tidak ada data",
                "sEmptyTable"    : "Data tidak tersedia",
                "sLoadingRecords": '<img src   = "{{ asset('ajax-loader.gif') }}"> Loading...'
            },           
            "ajax": {
                "url" : url,
                "type": method,
                "data": {
                    "no_kartu": no_kartu,
                    "tgl_akhir": tgl_akhir
                }
            },
            "columns": [
                {"mData": "no"},
                {"mData": "noKunjungan"},
                {"width": "10%", "mData": "tglKunjungan"},
                {"mData": "nama"},
                {"mData": "poli"},
                {"width": "3%", "mData": "pelayanan"},
                {"mData": "ppkPerujuk"}
            ]
        })
        oTable = $('#tabel-rujukan').DataTable();  
        $('#no_kartu').keyup(function(){
            oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        }); 
    }

    function getListRujukan(no_kartu, url, method, CSRF_TOKEN) {
        $('#tabel-rujukan').dataTable({
            "autoWidth"     : false,
            "Processing"    : true,
            "ServerSide"    : true,
            "sDom"          : "<t <'float-right' i><p >>",
            "iDisplayLength": 25,
            "bDestroy"      : true,
            "oLanguage"     : {
                "sLengthMenu"    : "_MENU_ ",
                "sInfo"          : "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                "sSearch"        : "Search Data: ",
                "sZeroRecords"   : "Tidak ada data",
                "sEmptyTable"    : "Data tidak tersedia",
                "sLoadingRecords": '<img src   = "{{ asset('ajax-loader.gif') }}"> Loading...'
            },           
            "ajax": {
                "url" : url,
                "type": method,
                "data": {
                    "no_kartu": no_kartu
                }
            },
            "columns": [
                {"mData": "no"},
                {"mData": "noKunjungan"},
                {"mData": "tglKunjungan"},
                {"mData": "nama"},
                {"width": "2%","mData": "poli"},
                {"mData": "pelayanan"},
                {"mData": "ppkPerujuk"}
            ]
        })
        oTable = $('#tabel-rujukan').DataTable();  
        $('#no_kartu').keyup(function(){
            oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        }); 
    }

    $(document).on('click', '#h-skdp', function() {
        var no_surat = $(this).data('surat'),
            jenis_surat = $(this).data('jenissurat'),
            kode_poli = $(this).val();
            // console.log(kode_poli)
        $('#no-surat').val(no_surat)
        $('#no-surat-lama').val(no_surat)

        if (jenis_surat == "SRI") {
            setSRI()
        }

        if (kode_poli == "HDL") {
            showDokterDPJP();
        }

        $('#modal-skdp').modal('hide')
    })

    $(document).on('click','#h-rujukan', function() {
        var no_rujukan = $(this).data('rujukan'),
            url = '/admin/ajax/bpjs/rujukan',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#no-rujukan').val(no_rujukan).attr('readonly', true);

        ajaxRujukan(no_rujukan, url, method, CSRF_TOKEN)

        $('#modal-rujukan').modal('hide');
    });

    $(document).on('click', '#h-rujukan-rs', function() {
        var no_rujukan = $(this).data('rujukan'),
            url = '/admin/ajax/bpjs/rujukanrs',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#no-rujukan').val(no_rujukan).attr('readonly', true);

        ajaxRujukan(no_rujukan, url, method, CSRF_TOKEN)

        $('#modal-rujukan').modal('hide');
    })

    $(document).on('click', '#h-sko', function() {
        var no_rujukan = $(this).data('rujukan'),
            nama_faskes = $(this).data('faskes'),
            jns_pelayanan = $(this).data('jnspelayanan'),
            url = '/admin/ajax/bpjs/carisep',
            method = 'POST',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#no-rujukan').val(no_rujukan).attr('readonly', true);
        $('#nama-faskes').val(nama_faskes).attr('readonly', true);

        ajaxCariSep(no_rujukan, url, method, CSRF_TOKEN);

        $('#modal-rujukan').modal('hide')
    })

    function ajaxCariSep(no_rujukan, url, method, CSRF_TOKEN) {
        $.ajax({
            url:url,
            method:method,
            dataType: "JSON",
            data: {
                no_sep: no_rujukan,
                _token: CSRF_TOKEN
            },
            success: function(data) {
                console.log(data)
                if (data.metaData.code == 200) {
                    $('#tgl-rujukan').val(data.response.tglSep)
                    $('#ppk-rujukan').val(data.response.noSep.substr(0,8))
                    $('#internal-rujukan').val(data.response.noSep) 
                    // setAsalRujukan(data.response.noSep.substr(0,8))
                    $('#asal-rujukan option[value='+2+']').attr('selected','selected').closest('#asal-rujukan').attr('disabled', 'true');
                    showSuratKontrol(data.response.noSep, "SKO")
                    showDokterDPJP()

                }
            }
        })
    }

    function ajaxRujukan(no_rujukan, url, method, CSRF_TOKEN) {
        $.ajax({
            url:url,
            method:method,
            data: {
                no_rujukan: no_rujukan,
                _token: CSRF_TOKEN
            },
            success: function(data) {
                d = JSON.parse(data);
                res = d.response;
                if (res !== null) {
                    setRujukan(res)
                }
            }
        })
    }

    // BLOM DI PAKAI
    function setAsalRujukan(ppk_rujukan)
    {
        var url = '/admin/ajax/ppkrujukan',
            method = 'get';

        $.ajax({
            url:url,
            method:method,
            data: {ppk_rujukan : ppk_rujukan},
            success: function(res) {
                console.log(res)
            }
        })
    }

    function setRujukan(res) {
        $('#tgl-rujukan').val(res.rujukan.tglKunjungan)
        $('#ppk-rujukan').val(res.rujukan.provPerujuk.kode)
        $('#nama-faskes').val(res.rujukan.provPerujuk.nama).attr('readonly', true)
        $('#kode-diagnosa').val(res.rujukan.diagnosa.kode)
        $('#nama-diagnosa').val(res.rujukan.diagnosa.nama)
        $('#internal-rujukan').val(res.rujukan.noKunjungan)
        $('#asal-rujukan option[value='+res.asalFaskes+']').attr('selected','selected').closest('#asal-rujukan').attr('disabled',true);
        if ($('#jns-pelayanan').val() == 1) {
            $('#kode-poli').val("000")
            $('#nama-poli').val("000")
        } else {
            $('#kode-poli').val(res.rujukan.poliRujukan.kode)
            $('#nama-poli').val(res.rujukan.poliRujukan.nama)
        }
        if (res.rujukan.poliRujukan.kode != "IGD") {
            showSuratKontrol(res.rujukan.noKunjungan, "SKU")
            showDokterDPJP(res.rujukan.poliRujukan.kode, res.rujukan.pelayanan.kode)
        }
        if ($('#no-telp').val() == "") {
            $('#no-telp').val(res.rujukan.peserta.mr.noTelepon)
        }
        showKatarak()
    }

    $('#nama-dpjp').on('change',function() {
        var kode_dpjp = $(this).val();
        $('#kode-dpjp').val(kode_dpjp);         
    })

    $(document).on('click', '#create-sep', function(e) {
        var form_sep = $('#form-sep'),
            url = '/admin/ajax/bpjs/insertsep',
            method = 'POST';

        form_sep.find('#asal-rujukan').prop('disabled', false).attr('readonly', false);
        form_sep.find('#kelas-rawat').prop('disabled', false).attr('disabled', false);

        $.ajax({
            url:url,
            method:method,
            data: form_sep.serialize(),
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if (data.metaData.code == 200 && data.metaData.response !== null) {
                    $('#tabel-message-success').show().html("<span class='text-success' id='success-sep'></span>");
                    $('#success-sep').html(data.metaData.message+" No Sep : "+data.response.sep.noSep).hide()
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

    // PRINT SEP
    $(document).on('click','#print-sep', function() {
        var no_reg = $(this).data('reg'),
            url = '{{ url("/admin/sep/print") }}/'+ no_reg;
            var w = window.open(url, "_blank", "width=850, height=600");
    })
</script>