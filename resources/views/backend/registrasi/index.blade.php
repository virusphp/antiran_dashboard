@extends('layouts.backend.master-backend')

@section('title')
Sep
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
                                <h4><i class="c-icon cil-menu"></i> Daftar Registrasi</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <a href="{{ route('registrasi.create') }}" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon cil-plus"></i>
                                        Sep
                                    </a>
                                </div>
                                <div class="d-md-none float-right">
                                    <a href="{{ route('registrasi.create') }}" class="btn btn-sm btn-primary mb-3">
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
                                       <div class="controls"> 
                                            <div class="input-group date" id="tanggal_reg" data-target-input="nearest">
                                            <input type="text" id="tgl_reg" name="tgl_reg" class="form-control datetimepicker-input" data-target="#tanggal_reg"/>
                                                <div class="input-group-append" data-target="#tanggal_reg" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="ci-icon cil-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
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
                                @include('backend.registrasi._table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.registrasi.modal-sep')
@endsection
@push('css')
<link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('lib/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    @include('backend.registrasi.scripts')
    @include('backend.registrasi.buatsep-scripts')
@endpush