<div class="modal fade" id="modal-sep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="col-md-4">
            <h5 class="modal-title" id="header-sep">Pembuatan SEP </h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-sep" action="" class="form-horizontal">
                <div class="row">

                    {{-- Form PROFIL --}}
                    @include('backend.registrasi._form-profil')

                    {{-- Form BIODATA --}}
                    @include('backend.registrasi._form-biodata')

                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          {{-- <input id="create-sep" type="button" class="btn btn-primary"> --}}
          <input id="create-sep" type="button" class="btn btn-sm btn-primary" tabindex="8" value="Create SEP">
        </div>
      </div>
    </div>
  </div>