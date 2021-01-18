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

    $('#tanggal-rujukan').datetimepicker({
        //  format: 'L',
       defaultDate: new Date(), 
        format: "DD-MM-YYYY"
    });

    $('#tgl-rujukan-klik').datetimepicker({
        //  format: 'L',
        defaultDate: new Date(), 
        format: "YYYY-MM-DD"
    });

    function clearMessage() {
        $('#tabel-message-success').hide();
        $('#tabel-message-error').hide();
        $('#success-rujukan').remove();
        $('#error-rujukan').remove();
    }

    $(document).ready(function() {
        clearMessage();
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

    // $(document).on('click', '#delete-registrasi', function() {
    //     var id = $(this).data('idx'),
    //         nama_registrasi = $(this).data('nama');
    //         // console.log(id,nama_registrasi)

    //     swalWithBootstrapButtons.fire({
    //       title:  'Anda yakin akan menghapus data??',
    //       text:   "Data: "+nama_registrasi,
    //       icon:   'warning',
    //       showCancelButton: true,
    //       confirmButtonText: 'Ya',
    //       cancelButtonText: 'No',
    //       reverseButtons: true
    //     }).then((result) => {
    //       if (result.value) {
    //         ajaxDestroy(id);
    //       } else if (result.dismiss === Swal.DismissReason.cancel) {
    //         swalWithBootstrapButtons.fire( 'Dibatalkan', 'Data registrasi terpilih batal di hapus:)', 'error')
    //       }
    //     })
    // })

    // function ajaxDestroy(idx) {
    //     var url = '/admin/ajax/pendaftaran/destroy',
    //         method = 'DELETE';

    //     $.ajax({
    //         url: url,
    //         method: method,
    //         data: {idx:idx},
    //         success: function(res) {
    //             // Pertnayaantkang 
    //             // console.log(res, res.result.nama_registrasi)
    //             swalWithBootstrapButtons.fire('Lapor!', res.message + '\nnama : '+res.result.nama_registrasi, 'success');
    //             $('#tabel-registrasi').DataTable().ajax.reload();
    //         },
    //         error: function(xhr){}
    //     });
    // }

    function ajaxLoad() {
        var term = $('#term').val(),
            tanggal = $('#tgl-rujukan').val();
        // console.log(term, tanggal);

       $('#tabel-rujukan-keluar').dataTable({
            "autoWidth": false,
            "Processing": true,
            "ServerSide": true,
            "sDom" : "<t <'float-right' i><p >>",
            "iDisplayLength": 25,
            "bDestroy": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                "sSearch": "Search Data :  ",
                "sZeroRecords": "Tidak ada data",
                "sEmptyTable": "Data tidak tersedia",
                "sLoadingRecords": '<img src="{{ asset('ajax-loader.gif') }}"> Loading...'
            },           
            "ajax": {
                "url" : "/admin/ajax/rujukan",
                "type": "GET",
                "data": {
                    "term" : term,
                    "tgl_rujukan" : tanggal
                }
            },
            "columns": [
                {"mData": "DT_RowIndex"},
                {"mData": "no_rujukan", "width" : "100"},
                {"mData": "no_rekamedik", "width" : "70"},
                {"mData": "nama_peserta"},
                {"mData": "tgl_rujukan", "width": "75"},
                {"mData": "nama_tujuan_rujukan" },
                {"mData": "action", "className": "text-center"},
            ],
        })
        oTable = $('#tabel-registrasi').DataTable();

        $('#term').keyup(function(){
        oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        });
    }
    
</script>