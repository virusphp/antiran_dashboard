<script type="text/javascript">
    function loadModal() {
        $('#form-ppk-dirujuk').hide()
        $('#form-poli-tujuan').hide()
    }

    $(document).ready(function() {
        loadModal();
    });

    $('#tipe-rujukan').change(function() {
        var type = $(this).val();
        if (type == 0) {
            $('#form-ppk-dirujuk').show();
            $('#form-poli-tujuan').show();
            $('#jenis-faskes').val(2)
        } else if (type == 1) {
            $('#form-ppk-dirujukan').show();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(2)
        } else  {
            $('#form-ppk-dirujukan').hide();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(1)
        }
    })

    function setTypeRujukan() {
        var type = $('#tipe-rujukan').val();
         if (type == 0) {
            $('#form-ppk-dirujuk').show();
            $('#form-poli-tujuan').show();
            $('#jenis-faskes').val(2)
        } else if (type == 1) {
            $('#form-ppk-dirujukan').show();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(2)
        } else if (type == 2) {
            $('#form-ppk-dirujukan').hide();
            $('#form-poli-tujuan').hide();
            $('#jenis-faskes').val(1)
        }
    }

    $('#modal-rujukan-post').on('hidden.bs.modal', function(){
        var form = $('#form-rujukan-keluar');
        
        $(this).find('form')[0].reset();
    })

    $(document).on('click', '#buat-rujukan', function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        loadModal();
        setTypeRujukan();
        $('#modal-rujukan-post').modal(options);
        $('#modal-rujukan-post').removeAttr('style');
    })

    $('#no-sep').keyup(function() {
        $('#no-sep-rujukan').val($(this).val())
    })

    $('#cari-sep').click(function() {
        var no_sep = $('#no-sep').val(),
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            method = 'POST',
            url = '/admin/ajax/bpjs/carisep';

        $.ajax({
            url:url,
            method:method,
            data: {no_sep:no_sep},
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                if (res.metaData.code == 200) {
                    res = res.response;
                    $('#m-tgl-rujukan').val(res.tglSep)
                    $('#no-rekamedik').val(res.peserta.noMr)
                    $('#no-kartu').val(res.peserta.noKartu)
                    $('#nama-pasien').val(res.peserta.nama)
                    $('#jns-kelamin').val(res.peserta.kelamin)
                    $('#tgl-lahir').val(res.peserta.tglLahir)
                    $('#hak-kelas').val(res.peserta.hakKelas)
                    $('#jns-peserta').val(res.peserta.jnsPeserta)
                    $('#asuransi').val(res.peserta.asuransi == null ? "" : res.peserta.asuransi)
                }
            }
        })
    })

     // GET POLI BPJS
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
                var asal_rujukan = $('#jenis-faskes').val();
                $.ajax({
                    url:url,
                    method: "POST",
                    dataType: "JSON",
                    data: {term: request.term, asal_rujukan: asal_rujukan},
                    success: function(data) {
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
                $('#ppk-dirujuk').val(ui.item.id);
                return false;
            }
        })
    })

    $('#create-rujukan').click(function() {
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

    // PRINT SRUJUKAN
    $(document).on('click','#print-rujukan', function() {
        var no_rujukan = $(this).data('rujukan'),
            no_sep = $(this).data('rujukan')
            url = '{{ url("/admin/rujukan/print") }}/'+ no_rujukan;
            var w = window.open(url, "_blank", "width=850, height=600");
        console.log(no_rujukan)
    })
</script>