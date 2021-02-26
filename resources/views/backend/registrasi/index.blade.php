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
                            {{-- widget card-header list left --}}
                            @include('backend.registrasi.widget._header-left')
                            {{-- widget card-header list right --}}
                            @include('backend.registrasi.widget._header-right')
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
@include('backend.registrasi.modal.modal-sep')
@include('backend.registrasi.modal.modal-rujukan')
@include('backend.registrasi.modal.modal-skdp')
@include('backend.registrasi.modal.modal-history')
@include('backend.registrasi.modal-registrasi')
@include('backend.registrasi.modal.modal-pulang')

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
    @include('backend.registrasi.scripts-buatsep')
    @include('backend.registrasi.scripts-editsep')
    @include('backend.registrasi.scripts-update-pulang')
    @include('backend.registrasi.scripts-registrasi')
@endpush