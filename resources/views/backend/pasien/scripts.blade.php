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

    $(document).on('click', '#delete-pasien', function() {
        var id = $(this).data('idx'),
            nama_pasien = $(this).data('nama');
            console.log(id,nama_pasien)

        swalWithBootstrapButtons.fire({
          title:  'Anda yakin akan menghapus data??',
          text:   "Data: "+nama_pasien,
          icon:   'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'No',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            ajaxDestroy(id);
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire( 'Dibatalkan', 'Data pasien terpilih batal di hapus:)', 'error')
          }
        })
    })

    function ajaxDestroy(idx) {
        var url = '/admin/ajax/pasien/destroy',
            method = 'DELETE';

        $.ajax({
            url: url,
            method: method,
            data: {idx:idx},
            success: function(res) {
                // Pertnayaantkang 
                console.log(res, res.result.nama_pasien)
                swalWithBootstrapButtons.fire('Lapor!', res.message + '\nnama : '+res.result.nama_pasien, 'success');
                $('#tabel-pasien').DataTable().ajax.reload();
            },
            error: function(xhr){}
        });
    }

    function ajaxLoad() {
        var term = $('#term').val(),
            asuransi = $('#asuransi').val();

       $('#tabel-pasien').dataTable({
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
                "url" : "/admin/ajax/pasien",
                "type": "GET",
                "data": {
                    "term" : term,
                    "asuransi" : asuransi
                }
            },
            "columns": [
                {"mData": "DT_RowIndex"},
                {"mData": "no_rm"},
                {"mData": "nama_pasien"},
                {"mData": "nik"},
                {"mData": "jns_kel"},
                {"mData": "no_kartu"},
                {"mData": "action"},
            ],
        })
        oTable = $('#tabel-pasien').DataTable();

        $('#term').keyup(function(){
        oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        });
    }
});
// Tutup function anonymus
</script>