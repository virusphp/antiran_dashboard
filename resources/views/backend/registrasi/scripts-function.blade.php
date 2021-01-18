<script type="text/javascript">
    $('#modal-sep').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#poli-tujuan b span').remove()
        $('#nama-pelayanan b span').remove()
        $("#header-sep span").remove(); 

        $('#asal-rujukan').find("option[selected]").removeAttr('selected');
    })

    $('#modal-history').on('hidden.bs.modal', function() {
        $("#tabel-history-peserta #isi-history tr").remove(); 
        $("#x-no-rm p").remove(); 
        $("#x-nama-peserta p").remove(); 
        $("#x-no-kartu p").remove(); 
    });

    function loadModal() {
        $('#form-skdp').hide();
        $('#form-katarak').hide();
        $("#form-penjamin-kll").hide();
        $('#form-asal-pasien').hide();

        $('#no-reg').val("")
        $('#no-rm').val("")
        $('#no-kartu').val("")
        $('#no-telp').val("")
        $('#nama-pasien').val("")
        $('#no-ktp').val("")
        $('#tgl-lahir').val("")
        $('#alamat').val("")
        $('#jns-pelayanan').val("")

        $('#no-surat').val("000000")
        $('#no-surat-lama').val("000000")
        $('#kode-dpjp').val("000000")
        $('#propinsi').val("0")
        $('#keterangan').val("0")
        $('#provinsi').prop('selectedIndex',0);
        $('#kabupaten option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#kecamatan option').prop('selected', function() {
            return this.defaultSelected;
        });
        var form = $('#form-sep');
        // Reset validationo error
        form.find('.invalid-feedback').remove();
        form.find('input').removeClass('is-invalid');
        form.find('textarea').removeClass('is-invalid');
      
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

    // SHOW DPJP
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

    // SURAT KONTROl
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

    function showKatarak()
    {
        if($('#kode-poli').val() === 'MAT') {
            $('#form-katarak').show();
        } else {
            $('#form-katarak').hide();
        }
    }

    // AUTOCOMPLETED
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

    // REGIONAL
    // GET PROVINSI
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

    // CHECKBOX
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

     // KATARAK
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

    function setSRI() {
        $('#asal-rujukan option[value='+2+']').attr('selected','selected').closest('#asal-rujukan');
        $('#nama-faskes').val("RSUD KRATON");
        $('#ppk-rujukan').val("1105R001");
    }
</script>