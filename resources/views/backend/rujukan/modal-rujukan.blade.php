<div class="modal fade" id="modal-rujukan-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="col-md-4">
            <h5 class="modal-title" id="header-rujukan">Pembuatan Rujukan Keluar </h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-rujukan-keluar" action="" class="form-horizontal">
                <div class="row">

                    {{-- Form PROFIL --}}
                    @include('backend.rujukan._form-biodata')

                    {{-- Form BIODATA --}}
                    @include('backend.rujukan._form-rujukan')

                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input id="create-rujukan" type="button" class="btn btn-primary" value="Create Rujukan">
        </div>
      </div>
    </div>
  </div>