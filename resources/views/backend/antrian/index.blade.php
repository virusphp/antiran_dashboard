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
                                <h4><i class="c-icon cil-menu"></i> Daftar Antrian</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <a href="{{ route('antrian.create') }}" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon cil-plus"></i>
                                        Antrian
                                    </a>
                                </div>
                                <div class="d-md-none float-right">
                                    <a href="{{ route('antrian.create') }}" class="btn btn-sm btn-primary mb-3">
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
                                        {{-- <div class="controls"> --}}
                                            {{-- <div class="input-prepend input-group">
                                                <div class="input-group-prepend" id="tgl-reg">
                                                    <span class="input-group-text">
                                                        <i class="cil-calendar"></i>
                                                    </span>
                                                </div> --}}
                                                <input class="form-control date-input" placeholder="dd-mm-yyyy" value="" min="1995-01-01" max="2030-12-31" id="tanggal_reg" name="tgl_reg" type="date">
                                                {{-- <span class="input-group-append">
                                                    <button id="cari-tanggal" class="btn btn-primary" type="button">
                                                        <i class="cil-search"></i>
                                                    </button>
                                                </span> --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                    </div>
                                    <div class="form-group my-2 mx-2">
                                        <div class="controls">
                                            <div class="input-group">
                                                <input class="form-control" id="cari-input" size="16" type="text">
                                                <span class="input-group-append">
                                                    <button id="cari-button" class="btn btn-secondary" type="button">Go!</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('backend.antrian._table')
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