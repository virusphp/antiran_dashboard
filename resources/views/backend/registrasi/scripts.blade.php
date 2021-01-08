<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        // Config Constanta Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }); 

        // Config Constanta Swal
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-3',
                cancelButton: 'btn btn-danger mx-3'
            },
            buttonsStyling: false
        });

    });

    $('#tanggal_reg').datetimepicker({
        //  format: 'L',
        defaultDate: new Date(), 
        format: "DD-MM-YYYY"
    });

    $('#tgl-reg-klik').datetimepicker({
        //  format: 'L',
        defaultDate: new Date(), 
        format: "YYYY-MM-DD"
    });
    
    $('#tgl-kejadian-klik').datetimepicker({
        //  format: 'L',
        defaultDate: new Date(), 
        format: "YYYY-MM-DD"
    });

    function clearMessage() {
        $('#tabel-message-success').hide();
        $('#tabel-message-error').hide();
        $('#success-sep').remove();
        $('#error-sep').remove();
    }

    $(document).ready(function() {
        clearMessage();
        listCaraBayar();
        ajaxLoad();
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).on('change','#term', function() {
        ajaxLoad();
    })

    $('#cari-button').click(function() {
        ajaxLoad();
    })

    // GET KELAS 
    function listCaraBayar() {
        var url = '/admin/ajax/list/carabayar',
            method = 'get';
        $.ajax({
            url:url,
            method:method,
            data: {},
            success: function(data) {
                $('#carabayar').empty();
                $('#carabayar').append('<option value="">Pilih Cara bayar</option>')
                $.each(data, function(key, value) {
                    $('#carabayar').append('<option value="'+value.kd_cara_bayar+'">'+value.keterangan+'</option>');
                });
                $('#carabayar').select2({
                    'placeholder': 'Pilih Cara bayar'
                })
            }
        })
    }

    function ajaxLoad() {
        var term = $('#term').val(),
            cara_bayar = $('#carabayar').val(),
            jns_rawat = $("input[name=jns_rawat]:checked").val(),
            tanggal = $('#tgl_reg').val();

       $('#tabel-registrasi').dataTable({
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
                "url" : "/admin/ajax/registrasi",
                "type": "GET",
                "data": {
                    "term" : term,
                    "cara_bayar" : cara_bayar,
                    "jns_rawat" : jns_rawat,
                    "tanggal_reg" : tanggal
                }
            },
            "columns": [
                {"mData": "DT_RowIndex"},
                {"mData": "no_reg"},
                {"mData": "no_rm"},
                {"mData": "nama_pasien"},
                {"mData": "tanggal_reg", "width": "70"},
                {"mData": "cara_bayar", "width" : "50"},
                {"mData": "no_sep"},
                {"mData": "status_rawat", "visible": false},
                {"mData": "action", "className" : "text-center"},
            ],
            "createdRow": function(row, data, dataIndex) {
                // console.log(data.status_rawat)
                if (data.status_rawat == "Batal") {
                    var panjang = $(row).find('td').length
                    for (i = 0; i < panjang - 1; i++) {
                        $(row).find('td').eq(i).addClass('merah');
                    }
                }
            }
        })
        oTable = $('#tabel-registrasi').DataTable();

        $('#term').keyup(function(){
        oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        });
    }

</script>