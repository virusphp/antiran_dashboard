@extends('layouts.backend.master-backend')

@section('title')
Sep
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
                                @include('widget.pencarian-sep')
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
@include('backend.registrasi.modal-rujukan')
@endsection
@push('css')
<link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script> 
    <script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script> 
    @include('backend.registrasi.scripts-function')
    @include('backend.registrasi.scripts')
    @include('backend.registrasi.buatsep-scripts')
    @include('backend.registrasi.editsep-scripts')
@endpush