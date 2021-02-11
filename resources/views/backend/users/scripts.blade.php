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
        confirmButton: 'btn btn-success mx-4',
        cancelButton: 'btn btn-danger mx-4'
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

      // cari pegawai
      $(document).ready(function() {
            var url = "/admin/ajax/list/pegawai"
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#nama_pegawai').autocomplete({
                source : function (request, response) {
                    $.ajax({
                        url : url,
                        dataType : "json",
                        data : { term: request.term },
                        success: function(data) {
                            var array = data.error ? [] : $.map(data, function(m) {
                                return {
                                    id : m.kd_pegawai,
                                    value : m.nama_pegawai,
                                    alamat : m.alamat,
                                    tglLahir : m.tgl_lahir,
                                    tmptLahir : m.tempat_lahir,
                                    unitKerja : m.unit_kerja,
                                    foto : m.foto
                                };
                            });
                            response(array);
                        }
                    });
                },
                minLength: 3,
                select : function (event, ui) {
                    $('#nama_pegawai').val(ui.item.value);
                    $('#username').val(ui.item.id).attr('readonly', true);
                    $('#v-username').val(ui.item.id).attr('readonly', true);
                    $('#v-nama').val(ui.item.value).attr('readonly', true);
                    $('#v-alamat').val(ui.item.alamat).attr('readonly', true);
                    $('#v-tgl-lahir').val(ui.item.tglLahir).attr('readonly', true);
                    $('#v-tmpt-lahir').val(ui.item.tmptLahir).attr('readonly', true);
                    $('#v-unit-kerja').val(ui.item.unitKerja).attr('readonly', true);
                    // $('#v-foto').attr('src', 'data:image/jpeg;base64,'+ui.item.foto);
                    $('#v-foto').attr('src', '{{ asset('images/user') }}/'+ui.item.foto);
                    return false;
                },
                autoFocus: true
            });
    });

    $(document).on('click','#tambah-user', function() {
        $(this).addClass('edit-item-trigger-clicked');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
            options = {
                'backdrop' : 'static'
            };

        $('#modal-user').modal(options);
    });

    $(document).on('change','#term', function() {
        ajaxLoad();
    })

    $(document).on('click', '#delete-user', function() {
        var id = $(this).data('idx'),
            name = $(this).data('name');

        swalWithBootstrapButtons.fire({
          title:  'Anda yakin akan menghapus data??',
          text:   "Data: "+name,
          icon:   'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'No',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            ajaxDestroy(id);
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire( 'Dibatalkan', 'Data User terpilih batal di hapus:)', 'error')
          }
        })
    })

    function ajaxDestroy(idx) {
        var url = '/admin/ajax/users/destroy',
            method = 'DELETE';

        $.ajax({
            url: url,
            method: method,
            data: {idx:idx},
            success: function(res) {
                console.log(res.result);
                swalWithBootstrapButtons.fire('Lapor!', res.message,'success');
                $('#tabel-users').DataTable().ajax.reload();
            },
            error: function(xhr){}
        });
    }

    function ajaxLoad() {
        var term = $('#term').val();

       $('#tabel-users').dataTable({
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
                "url" : "/admin/ajax/users",
                "type": "GET",
                "data": {
                    "term" : term
                }
            },
            "columns": [
                {"mData": "DT_RowIndex"},
                {"mData": "kd_pegawai"},
                {"mData": "nama_pegawai"},
                {"mData": "role"},
                {"mData": "unit_kerja"},
                {"mData": "action"},
            ],
        })
        oTable = $('#tabel-users').DataTable();

        $('#term').keyup(function(){
        oTable.search($(this).val()).draw() ;
            $('.table').removeAttr('style');
        });
    }
});
// Tutup function anonymus
</script>