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

        // SELECT 2 DROP DOWN
        $('#cara-bayar').val("")
        $('#asal-pasien').val("")
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

        if (data.jns_pelayanan == 2) {
            $('#nama-pelayanan b').append('<span>Rawat Jalan</span>')
            $('#poli-tujuan b').append('<span>Poli Tujuan : '+data.nama_sub_unit+'</span>')
        } else {
            $('#nama-pelayanan b').append('<span>Rawat Inap</span>')
            $('#poli-tujuan b').append('<span>Ruang : '+data.nama_sub_unit+'</span>')
        }

        // SELECT 2 DROP DOWN
        getKelas()
        getCaraBayar(data.cara_bayar)
        getAsalPasien(data.asal_pasien)
        getInstansi()
    }

    $('#modal-sep').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#poli-tujuan b span').remove()
        $('#nama-pelayanan b span').remove()
    })

    // GET KELAS BPJS
    function getKelas() {
        var url = '/admin/ajax/list/kelas',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#kelas-rawat').empty();
                $('#kelas-rawat').append('<option>Pilih kelas</option>')
                $.each(data, function(key, value) {
                    $('#kelas-rawat').append('<option value="'+key+'">'+value+'</option>');
                });
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
                $('#cara-bayar').append('<option>Pilih Carabayar</option>')
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
                $('#asal-pasien').append('<option>Pilih Asal Pasien</option>')
                $.each(data, function(key, value) {
                    $('#asal-pasien').append('<option value="'+value.kd_asal_pasien.trim()+'">'+value.keterangan+'</option>');
                });
                console.log(asalpasien)
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
                $('#nama-instansi').append('<option>Pilih Instansi</option>')
                $.each(data, function(key, value) {
                    $('#nama-instansi').append('<option value="'+value.kd_instansi+'">'+value.nama_instansi+'</option>');
                });
                $('#nama-instansi').select2({
                    'placeholder': 'Pilih Asal pasien'
                })
            }
        })
    }
</script>