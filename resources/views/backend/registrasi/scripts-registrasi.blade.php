<script type="text/javascript">
    function loadModalRegistrasi() {
        $('#r-kode-poli').empty();
        $('#r-kode-penjamin').empty();
        $('#r-kode-dokter').empty();
        $('#r-cara-bayar').empty();
        $('#r-cara-masuk').empty();

        $('#r-kode-tarif').val("");
        $('#r-tarif-klinik').val("");
    }

    $(document).ready(function() {
        window.setTimeout("waktu()", 1000);
    });

    function waktu()
    {
        var waktu = new Date();
		setTimeout("waktu()", 1000);
        $('#r-jam-registrasi').val(waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds());
    }

    $(document).on('click', '#registrasi-pasien', function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        loadModalRegistrasi();
        nomorRegistrasi("01");
        getKlinik()
        getDokter()
        getCaraBayar()
        getCaraMasuk()

        $('#modal-registrasi').modal(options);
        $('#modal-registrasi').removeAttr('style');
    })

    $('#r-no-rm').on('change', function() {
       pencarian() 
    })

     $('#r-kode-poli').on('change',function() {
        var kode_tarif = $(this).find(':selected').data('tarif'),
            harga = $(this).find(':selected').data('harga'),
            dokter  = $(this).find(':selected').data('dokter');
        $('#r-tarif-klinik').val(harga);         
        $('#r-kode-tarif').val(kode_tarif);

        getDokter(dokter);
    })

    $('#r-cara-bayar').on('change', function() {
        var carabayar = $(this).val();
        getPenjamin(carabayar);
    })


    $('#cari-rm').click(function() {
       pencarian()
    })

    function nomorRegistrasi(jenisRawat) {
        var url = '/admin/ajax/generate/noregistrasi',
            method = 'POST'
        $.ajax({
            url:url,
            method:method,
            data: {jnsRawat:jenisRawat},
            dataType: 'JSON',
            success:function(res) {
                if (res.code == 200) {
                    $('#r-no-registrasi').val(res.result.generate.no_reg);
                }
            } 
        })
    }

    function pencarian() {
        var no_rm = $('#r-no-rm').val(),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            method = 'POST',
            url = '/admin/ajax/pasien/cari';

        $.ajax({
            url:url,
            method:method,
            data: {no_rm:no_rm},
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                if (res.code == 200) {
                    res = res.result.pasien;
                    $('#r-nama-pasien').val(res.nama_pasien)
                    $('#r-tempat-lahir').val(res.tempat_lahir)
                    $('#r-tanggal-lahir').val(res.tanggal_lahir)
                    $('#r-jns-kelamin').val(res.jenis_kelamin)
                    $('#r-no-telp').val(res.no_telp)
                    $('#r-alamat-pasien').val(res.alamat_pasien)
                }
            }
        })
    }

     // GET NAMA INSTANSI
     function getKlinik() {
        var url = '/admin/ajax/list/poliklinik',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                if (data.code == 200) {
                    $('#r-kode-poli').empty();
                    $('#r-kode-poli').append('<option value="">Pilih Poliklinik</option>')
                    $.each(data.result.poliklinik, function(key, value) {
                        $('#r-kode-poli').append('<option value="'+$.trim(value.kode_klinik)+'" data-tarif="'+$.trim(value.kode_tarif)+'" data-harga="'+value.harga+'" data-dokter="'+$.trim(value.kode_dokter)+'">'+value.nama_klinik+'</option>');
                    });
                    $('#r-kode-poli').select2({
                        placeholder: 'Pilih Poliklinik',
                        width: '100%',
                    })
                } 
            }
        })
    }

    // GET CARA BAYAR
    function getCaraBayar() {
        var url = '/admin/ajax/list/carabayar',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                if (data.code == 200) {
                    $('#r-cara-bayar').empty();
                    $('#r-cara-bayar').append('<option value="">Pilih Cara Bayar</option>')
                    $.each(data.result.carabayar, function(key, value) {
                        $('#r-cara-bayar').append('<option value="'+value.kode_carabayar+'">'+value.nama_carabayar+'</option>');
                    });
                    $('#r-cara-bayar').select2({
                        placeholder: 'Pilih Carabayar',
                        width: '100%',
                    })
                }
            }
        })
    }

     // GET CARA MASUK
     function getCaraMasuk() {
        var url = '/admin/ajax/list/caramasuk',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                if (data.code == 200) {
                    $('#r-cara-masuk').empty();
                    $('#r-cara-masuk').append('<option value="">Pilih Cara Masuk</option>')
                    $.each(data.result.caramasuk, function(key, value) {
                        $('#r-cara-masuk').append('<option value="'+value.kode_caramasuk+'">'+value.nama_caramasuk+'</option>');
                    });
                    $('#r-cara-masuk').select2({
                        placeholder: 'Pilih Caramasuk',
                        width: '100%',
                    })
                }
            }
        })
    }

    // GET PENJAMIN
    function getPenjamin(carabayar) {
        var url = '/admin/ajax/list/penjamin',
            method = 'POST';
        if (carabayar != 1 || carabayar != 9) {
            $.ajax({
                url:url,
                method:method,
                data: {carabayar:carabayar},
                dataType: "JSON",
                success: function(data) {
                    if (data.code == 200) {
                            $('#r-kode-penjamin').empty();
                            $('#r-kode-penjamin').append('<option value="">Pilih Penjamin</option>')
                            $.each(data.result.penjamin, function(key, value) {
                                $('#r-kode-penjamin').append('<option value="'+$.trim(value.kode_penjamin)+'">'+value.nama_penjamin+'</option>');
                            });

                            $('#r-kode-penjamin').select2({
                                placeholder: 'Pilih Penjamin',
                                width: '100%',
                            })
                        } 
                } 
            })
        } else {
            $('#r-kode-penjamin').empty();
        }
        
    }

    function getDokter(kode_dokter = null) {
        var url = '/admin/ajax/list/poliklinik',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                if (data.code == 200) {
                    $('#r-kode-dokter').empty();
                    $('#r-kode-dokter').append('<option value="">Pilih Dokter</option>')
                    $.each(data.result.poliklinik, function(key, value) {
                        $('#r-kode-dokter').append('<option value="'+$.trim(value.kode_dokter)+'">'+value.nama_dokter+'</option>');
                    });
                    if (kode_dokter) {
                        $('#r-kode-dokter option[value='+kode_dokter+']').attr('selected','selected').closest('#r-kode-dokter');
                    }
                    $('#r-kode-dokter').select2({
                        placeholder: 'Pilih Dokter',
                        width: '100%',
                    })
                } 
            }
        })
    }

</script>