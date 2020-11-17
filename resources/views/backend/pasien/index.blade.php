@extends('layouts.backend.master-backend')

@section('title')
Pasien
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
                                <h4><i class="c-icon cil-menu"></i> Daftar Pasien</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon cil-plus"></i>
                                        Pasien
                                    </a>
                                </div>
                                <div class="d-md-none float-right">
                                    <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-primary mb-3">
                                        <i class="c-icon cil-plus"></i>

                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                  <div class="d-flex float-right">
                                    <div class="form-group my-2 mx-2">
                                        <select class="form-control" name="asuransi" id="asuransi">
                                            <option value="0">NON BPJS</option>
                                            <option value="1">BPJS</option>
                                        </select>
                                       {{-- <input class="form-control date-input" placeholder="dd-mm-yyyy" value="" min="1995-01-01" max="2030-12-31" id="tanggal_reg" name="tgl_reg" type="date"> --}}
                                    </div>
                                    <div class="form-group my-2 mx-2">
                                        <div class="controls">
                                            <div class="input-group">
                                                <input class="form-control" name="term" id="term" size="16" type="text">
                                                <span class="input-group-append">
                                                    <button id="cari-button" class="btn btn-secondary" type="button">Go!</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('backend.pasien._table')
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
    @include('backend.pasien.scripts')
@endpush