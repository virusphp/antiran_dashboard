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

    $('#modal-sep').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#poli-tujuan b span').remove()
        $('#nama-pelayanan b span').remove()
        $("#header-sep span").remove(); 

        $('#asal-rujukan').find("option[selected]").removeAttr('selected');
    })

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
        $('#asal-rujukan option[value='+jns_pelayanan+']').attr('selected','selected').closest('#asal-rujukan').attr('disabled', 'true');

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
        getKatarak()
    }

    function showDokterDPJP(poli = "INT", jns_pelayanan = "1") {
        $.ajax({
            url: '/admin/ajax/bpjs/list/dpjp',
            method: 'POST',
            dataType: 'JSON',
            data: {
                poli : poli,
                jns_pelayanan : jns_pelayanan
            },
            success: function(data) {
                if (data.metaData.code == 200) {
                    $('#nama-dpjp').empty();
                    $('#nama-dpjp').append('<option value="0">Pilih Dpjp</option>')
                    $.each(data.response.list, function(key, value) {
                        $('#nama-dpjp').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                    });
                    $('#nama-dpjp').select2({
                        'placeholder': 'Pilih Carabayar'
                    })
                }
              
            }
        })
    }

    $('#nama-dpjp').on('change',function() {
        var kode_dpjp = $(this).val();
        $('#kode-dpjp').val(kode_dpjp);         
    })

    function showSuratKontrol(no_rujukan, jns_surat) {
        var url = '/admin/ajax/rujukaninternal',
            method = 'GET';
        if (no_rujukan !== 0) {
            $.ajax({
                url:url,
                method:method,
                data: {
                    no_rujukan:no_rujukan
                },
                success: function(data) {
                    if (jns_surat == "SKU") {
                        if (data.length > 0) {
                            $('#form-skdp').show();
                        }
                    } else {
                        $('#form-skdp').show();
                    }
                }
            })
        }
    }

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
                if (data.response !== null) {
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

    // COB
    $('#c-cob').click(function() {
        if ($(this).is(':checked')) {
            $('#cob').val(1);
        } else {
            $('#cob').val(0);
        }
    })

     // POLI EKSEKUTIF
     $('#c-eksekutif').click(function() {
        if ($(this).is(':checked')) {
            $('#eksekutif').val(1);
        } else {
            $('#eksekutif').val(0);
        }
    })

     // COB
     $('#c-katarak').click(function() {
        if ($(this).is(':checked')) {
            $('#katarak').val(1);
        } else {
            $('#katarak').val(0);
        }
    })

      // SHOW PENJAMIN KLL
    $('#c-penjamin').click(function() {
        if ($(this).is(':checked')) {
            $('#penjamin').val(1);
            $('#lakalantas').val(1);
            $('#form-penjamin-kll').show(500);
            $('#keterangan').val("");
        } else {
            $('#penjamin').val(0);
            $('#lakalantas').val(0);
            $('#keterangan').val(0);
            $('#form-penjamin-kll').hide(500);
            $('#propinsi').val(0).select2({ width: 'resolve'});
            $('#kabupaten').val(0).select2({ width: 'resolve'});
            $('#kecamatan').val(0).select2({ width: 'resolve'});
        }
      getProvinsi() 
    })  

    // GET POLI BPJS
    $(document).ready(function() {
        var url = '/admin/ajax/bpjs/list/poli',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#nama-poli').autocomplete({
            source : function(request, response){
                $.ajax({
                    url:url,
                    method: "POST",
                    dataType: "JSON",
                    data: {term: request.term},
                    success: function(data) {
                        if (data.metaData.code == 200) {
                            var array = data.error ? [] : $.map(data.response.poli, function(m){
                                return {
                                    id : m.kode,
                                    value: m.nama
                                }
                            })
                            response(array);
                        }
                    }
                })
            },
            minLength: 3,
            select : function(event, ui) {
                $('#nama-poli').val(ui.item.value);
                $('#kode-poli').val(ui.item.id);
                getKatarak();
                return false;
            }
        })
    })

     // GET FASKES BPJS
     $(document).ready(function() {
        var url = '/admin/ajax/bpjs/list/faskes',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#nama-faskes').autocomplete({
            source : function(request, response){
                var asal_rujukan = $('#asal-rujukan').val();
                $.ajax({
                    url:url,
                    method: "POST",
                    dataType: "JSON",
                    data: {term: request.term, asal_rujukan: asal_rujukan},
                    success: function(data) {
                        console.log(data.response)
                        if (data.metaData.code == 200) {
                            var array = data.error ? [] : $.map(data.response.faskes, function(m){
                                return {
                                    id : m.kode,
                                    value: m.nama
                                }
                            })
                            response(array);
                        }
                    }
                })
            },
            minLength: 3,
            select : function(event, ui) {
                $('#nama-faskes').val(ui.item.value);
                $('#ppk-rujukan').val(ui.item.id);
                return false;
            }
        })
    })

     // GET DIAGNOSA BPJS
     $(document).ready(function() {
        var url = '/admin/ajax/bpjs/list/diagnosa',
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#nama-diagnosa').autocomplete({
            source : function(request, response){
                $.ajax({
                    url:url,
                    method: "POST",
                    dataType: "JSON",
                    data: {term: request.term},
                    success: function(data) {
                        // console.log(data.response.diagnosa)
                        if (data.metaData.code == 200) {
                            var array = data.error ? [] : $.map(data.response.diagnosa, function(m){
                                return {
                                    id : m.kode,
                                    value: m.nama
                                }
                            })
                            response(array);
                        }
                    }
                })
            },
            minLength: 3,
            select : function(event, ui) {
                $('#nama-diagnosa').val(ui.item.value);
                $('#kode-diagnosa').val(ui.item.id);
                return false;
            }
        })
    })

    // GET KELAS BPJS
    function getKelas(hakkelas) {
        var url = '/admin/ajax/list/kelas',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#kelas-rawat').empty();
                $('#kelas-rawat').append('<option value="0">Pilih kelas</option>')
                $.each(data, function(key, value) {
                    $('#kelas-rawat').append('<option value="'+key+'">'+value+'</option>');
                });
                if (hakkelas) {
                    $('#kelas-rawat option[value='+hakkelas+']').attr('selected','selected').closest('#kelas-rawat').attr('disabled', true);
                }
                $('#kelas-rawat').select2({
                    'placeholder': 'Pilih kelas'
                })
            }
        })
    }

    // GET CARA BAYAR
    function getCaraBayar(carabayar) {
        var url = '/admin/ajax/list/carabayar',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#cara-bayar').empty();
                $('#cara-bayar').append('<option value="">Pilih Cara bayar</option>')
                $.each(data, function(key, value) {
                    $('#cara-bayar').append('<option value="'+value.kd_cara_bayar+'">'+value.keterangan+'</option>');
                });
                if (carabayar) {
                    $('#cara-bayar option[value='+carabayar+']').attr('selected','selected').closest('#cara-bayar');
                }
                $('#cara-bayar').select2({
                    'placeholder': 'Pilih Cara bayar'
                })
            }
        })
    }

    // GET ASAL PASIEN
    function getAsalPasien(asalpasien) {
        var url = '/admin/ajax/list/asalpasien',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#asal-pasien').empty();
                $('#asal-pasien').append('<option value="0">Pilih Asal Pasien</option>')
                $.each(data, function(key, value) {
                    $('#asal-pasien').append('<option value="'+value.kd_asal_pasien.trim()+'">'+value.keterangan+'</option>');
                });
                if (asalpasien) {
                    $('#asal-pasien option[value='+asalpasien+']').attr('selected','selected').closest('#asal-pasien');
                }
                $('#asal-pasien').select2({
                    'placeholder': 'Pilih Asal pasien'
                })
            }
        })
    }

    // GET NAMA INSTANSI
    function getInstansi(kode_instansi) {
        var url = '/admin/ajax/list/instansi',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#nama-instansi').empty();
                $('#nama-instansi').append('<option value="">Pilih Instansi</option>')
                $.each(data, function(key, value) {
                    $('#nama-instansi').append('<option value="'+$.trim(value.kd_instansi)+'">'+value.nama_instansi+'</option>');
                });
                if (kode_instansi) {
                    $('#nama-instansi option[value='+kode_instansi+']').attr('selected','selected').closest('#nama-instansi');
                }
                $('#nama-instansi').select2({
                    'placeholder': 'Pilih Asal pasien'
                })
            }
        })
    }

    // GET PESERTA BPJS
    function getPeserta()
    {
        var url = '/admin/ajax/bpjs/peserta',
            method = 'post',
            no_kartu = $('#no-kartu').val(),
            tgl_reg = $('#tgl-reg').val();
        $.ajax({
            url:url,
            method:method,
            data: {
                no_kartu:no_kartu,
                tgl_reg:tgl_reg
            },
            success: function(data) {
                d = JSON.parse(data);
                if (d.response !== null) {
                    res = d.response.peserta
                    $('#peserta').val(res.statusPeserta.keterangan+' '+res.jenisPeserta.keterangan)
                    getKelas(res.hakKelas.kode)
                }
            }
        })
    }

    function getKatarak()
    {
        if($('#kode-poli').val() === 'MAT') {
            $('#form-katarak').show();
        } else {
            $('#form-katarak').hide();
        }
    }

    function getProvinsi()
    {
        var url = '/admin/ajax/list/propinsi',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#propinsi').empty();
                $('#propinsi').append('<option value="0">Pilih Propinsi</option>')
                $.each(data, function(key, value) {
                    $('#propinsi').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                });
                $('#propinsi').select2({
                    'placeholder': 'Pilih propinsi'
                })
            }
        })
    }

    $('#propinsi').on('change',function() {
        var kd_prov = $(this).val(),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type : 'post',
            url : '/admin/ajax/list/kabupaten',
            data : {kd_prov:kd_prov},
            success: function(data) {
                $('#kabupaten').empty();
                $('#kabupaten').append('<option value="0">Pilih Kabupaten</option>')
                $.each(data, function(key, value) {
                    $('#kabupaten').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                });
                $('#kabupaten').select2({
                    'placeholder': 'Pilih kabupaten'
                })
            } 
        });
    });

    $('#kabupaten').on('change',function() {
        var kd_kab = $(this).val(),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type : 'post',
            url : '/admin/ajax/list/kecamatan',
            data : {kd_kab:kd_kab},
            success: function(data) {
                $('#kecamatan').empty();
                $('#kecamatan').append('<option value="0">Pilih Kecamatan</option>')
                $.each(data, function(key, value) {
                    $('#kecamatan').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                });

                $('#kecamatan').select2({
                    'placeholder': 'Pilih kabupaten'
                })
            } 
        });
    });

</script>