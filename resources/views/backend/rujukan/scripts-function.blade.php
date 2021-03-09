<script type="text/javascript">
    function loadModal() {
        $('#form-ppk-dirujuk').hide()
        $('#form-poli-tujuan').hide()
    }

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

    function cariSep(no_sep)
    {
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
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
    }

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

</script>