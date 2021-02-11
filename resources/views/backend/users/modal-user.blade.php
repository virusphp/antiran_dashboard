<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="col-md-4">
            <h5 class="modal-title" id="header-user"> Management Users </h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="row">

                    {{-- Form PROFIL --}}
                    @include('backend.users._form-profil')

                    {{-- Form BIODATA --}}
                    @include('backend.users._form-biodata')

                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>