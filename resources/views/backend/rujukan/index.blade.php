@extends('layouts.backend.master-backend')

@section('title')
Rujukan
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div id="tabel-message-success" class="alert alert-success">
                    <!-- success message -->
                </div>
                <div id="tabel-message-error" class="alert alert-danger">
                    <!-- success message -->
                </div>
                <div class="card rounded-lg">
                    <div class="card-header d-flex-align-items-center pb-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item float-left">
                                <h4><i class="c-icon cil-menu"></i> Daftar Rujukan Keluar</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <button id="buat-rujukan" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon fa fa-plus"></i>
                                        Pembuatan Rujukan
                                    </button>
                                </div>
                                <div class="d-md-none float-right">
                                    <button id="buat-rujukan" class="btn btn-sm btn-primary mb-3">
                                        <i class="c-icon cil-plus"></i>

                                    </button>
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
                                            <div class="input-group date" id="tanggal-rujukan" data-target-input="nearest">
                                            <input type="text" id="tgl-rujukan" name="tgl_rujukan" class="form-control datetimepicker-input" data-target="#tanggal-rujukan"/>
                                                <div class="input-group-append" data-target="#tanggal-rujukan" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
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
                                @include('backend.rujukan._table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.rujukan.modal-rujukan')
@endsection
@push('css')
<link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/autocompleted.css') }}" rel="stylesheet">
<link href="{{ asset('lib/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script> 
    <script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script> 
    @include('backend.rujukan.scripts-index')
    @include('backend.rujukan.scripts-buatrujukan')
@endpush