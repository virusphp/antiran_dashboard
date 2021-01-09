{{-- <script src="{{ asset('lib/datedropper/datedropper.pro.min.js') }}"></script> --}}
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

    $(document).ready(function() {
        $('.date-input').val(new Date().toISOString().slice(0, 10));
        ajaxLoad();
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // $('.date-input').dateDropper({
    //     theme: 'leaf',
    //     format: 'd-m-Y',
    //     modal: true,
    //     largeDefault: true,
    //     largeOnly: true,
    //     minYear: 2020,
    //     autofill: true
    // });

    // $('#tgl-reg').css('cursor','pointer');

    // $('#tgl-reg').click(function() {
    //     $('.date-input').focus();
    //     return false;
    // })

    $('#cari-button').click(function() {
        ajaxLoad();
    })

    $(document).on('change','#term', function() {
        ajaxLoad();
    })

    $(document).on('click', '#delete-antrian', function() {
        var id = $(this).data('idx'),
            nama_antrian = $(this).data('nama');
            console.log(id,nama_antrian)

        swalWithBootstrapButtons.fire({
          title:  'Anda yakin akan menghapus data??',
          text:   "Data: "+nama_antrian,
          icon:   'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'No',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            ajaxDestroy(id);
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire( 'Dibatalkan', 'Data antrian terpilih batal di hapus:)', 'error')
          }
        })
    })

    function ajaxDestroy(idx) {
        var url = '/admin/ajax/antrian/destroy',
            method = 'DELETE';

        $.ajax({
            url: url,
            method: method,
            data: {idx:idx},
            success: function(res) {
                // Pertnayaantkang 
                swalWithBootstrapButtons.fire('Lapor!', res.message+' nama : '+res.result.nama_antrian,'success');
                $('#tabel-antrian').DataTable().ajax.reload();
            },
            error: function(xhr){}
        });
    }

    function ajaxLoad() {
        var term = $('#term').val(),
            tanggal = $('#tanggal_reg').val();

       $('#tabel-antrian').dataTable({
            "autoWidth": false,
            "Processing": true,
            "ServerSide": true,
            "sDom" : "<t<p >>",
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
                "url" : "/admin/ajax/antrian",
                "type": "GET",
                "data": {
                    "term" : term,
                    "tanggal" : tanggal
                }
            },
            "columns": [
                {"mData": "DT_RowIndex"},
                {"mData": "nama_poliklinik"},
                {"mData": "jumlah_antrian"},
            ],
        })
        oTable = $('#tabel-antrian').DataTable();

        $('#term').keyup(function(){
        oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        });
    }
});
// Tutup function anonymus
</script>