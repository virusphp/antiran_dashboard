<script type="text/javascript">
    function loadModal() {
        $('#form-skdp').hide();
        $('#form-katarak').hide();
        $("#form-penjamin-kll").hide();

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

        // SELECT 2 DROP DOWN
        $('#kelas-rawat').attr('readonly', false);
        $('#kelas-rawat').attr('disabled', false);
    
    }

    $(document).ready(function() {
        loadModal();
    });

    $(document).on('click',"#buat-sep", function() {
        var no_reg = $(this).data('reg'),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            },
            method = 'POST',
            url = '/admin/ajax/registrasi/modalsep';

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
                getDataPasien(data);
                getProvinsi();
            }
        });
        $('#modal-sep').modal(options);
        $('#modal-sep').removeAttr('style');
    })

    // SET DATA KE MODAL
    function getDataPasien(data) {
        console.log(data)
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
    }

    $('#modal-sep').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#poli-tujuan b span').remove()
        $('#nama-pelayanan b span').remove()
    })

    $('#cari-rujukan').on('click', function() {
        var no_kartu = $('#no-kartu').val(),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        getListRujukan(no_kartu);

        $('#modal-rujukan').modal(options)
    });

    function getListRujukan(no_kartu) {
        console.log(no_kartu);
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
                "url" : "/admin/ajax/bpjs/listrujukan",
                "type": "POST",
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

        $.ajax({
            url:url,
            method:method,
            data: {
                no_rujukan: no_rujukan,
                _token: CSRF_TOKEN
            },
            success: function(data) {
                console.log(data);
                d = JSON.parse(data);
                res = d.response;
                if (res !== null) {
                    $('#tgl-rujukan').val(res.rujukan.tglKunjungan)
                    $('#ppk-rujukan').val(res.rujukan.provPerujuk.kode)
                    $('#nama-faskes').val(res.rujukan.provPerujuk.nama).attr('readonly', true)
                    $('#nama-diagnosa').val(res.rujukan.diagnosa.nama)
                    $('#kode-diagnosa').val(res.rujukan.diagnosa.kode)
                    $('#nama-poli').val(res.rujukan.poliRujukan.nama)
                    $('#kode-poli').val(res.rujukan.poliRujukan.kode)
                    $('#internal-rujukan').val(res.rujukan.noKunjungan)
                    $('#asal-rujukan option[value='+res.asalFaskes+']').attr('selected','selected').closest('#asal-rujukan').attr('disabled','true');
                    if ($('#no-telp').val() == "") {
                        $('#no-telp').val(res.rujukan.peserta.mr.noTelepon)
                    }
                    getKatarak()

                }
            }
        })

        $('#modal-rujukan').modal('hide');
    });

    $('#create-sep').on('click', function() {
        var form_sep = $('#form-sep'),
            url = '/admin/ajax/bpjs/insertsep',
            method = 'POSt';

        form_sep.find('#asal-rujukan').prop('disabled', false)
        form_sep.find('#kelas-rawat').prop('disabled', false);

        $.ajax({
            url:url,
            method:method,
            data: form_sep.serialize(),
            dataType: "json",
            success: function(data) {
                console.log(data)
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
                $('#cara-bayar').append('<option value="0">Pilih Carabayar</option>')
                $.each(data, function(key, value) {
                    $('#cara-bayar').append('<option value="'+value.kd_cara_bayar+'">'+value.keterangan+'</option>');
                });
                if (carabayar) {
                    $('#cara-bayar option[value='+carabayar+']').attr('selected','selected').closest('#cara-bayar');
                }
                $('#cara-bayar').select2({
                    'placeholder': 'Pilih Carabayar'
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
    function getInstansi() {
        var url = '/admin/ajax/list/instansi',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#nama-instansi').empty();
                $('#nama-instansi').append('<option value="0">Pilih Instansi</option>')
                $.each(data, function(key, value) {
                    $('#nama-instansi').append('<option value="'+value.kd_instansi+'">'+value.nama_instansi+'</option>');
                });
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

</script>