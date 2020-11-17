@extends('layouts.backend.master-backend')

@section('title')
Antrian
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg">
                    <div class="card-header d-flex-align-items-center pb-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item float-left">
                                <h4><i class="c-icon cil-bullhorn"></i> Control Antrian</h4>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        UMUM
                                    </div>
                                    <div class="card-body text-center">
                                        <h1 class="display-1">002</h1>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-md float-left">Panggil</button>
                                                <button class="btn btn-outline-success btn-md float-right">Next <i class="ti-arrow-right"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                  <div class="card-body">
          
                                    <div class="card-title"><i class="ci-icon cil-bell"></i> List Antrian</div>
                                    <div class="table-responsive pt-3">
                                      <table class="table table-bordered table-hover">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>No Antrian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>1</td>
                                            <td> 001</td>
                                            <td>
                                              <div class="row">
                                                <label class="badge badge-success mx-auto">Dipanggil</label>
                                              </div>
                                            </td>
                                            <td>
                                                <button class="btn-pill btn-block btn-primary">
                                                    <i class="ci-icon cil-bell"></i>
                                                </button>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    @include('backend.antrian.scripts')
@endpush