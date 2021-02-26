<div class="modal fade" id="modal-pulang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dark" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <div class="col-md-4">
          <h5 class="modal-title" id="header-sep">Pemulangan Pasien </h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-update-pulang" class="form-horizontal">
          <div class="row">
              {{-- Form Pemulagan --}}
              @include('backend.registrasi.form._form-pulang')

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <input id="update-pulang" type="button" class="btn btn-sm btn-primary" tabindex="4" value="Pulangkan">
        <button type="button" tabindex="5" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>