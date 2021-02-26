<div class="modal fade" id="modal-registrasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="col-md-4">
            <h5 class="modal-title" id="header-registrasi">Pasien </h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-registrasi-masuk" action="" class="form-horizontal">
                <div class="row">

                    {{-- Form PROFIL --}}
                    @include('backend.registrasi._form-biodata-pasien')

                    {{-- Form BIODATA --}}
                    @include('backend.registrasi._form-registrasi-pasien')

                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <input id="daftar-registrasi" type="button" class="btn btn-sm sm btn-primary" value="Daftar">
        </div>
      </div>
    </div>
  </div>