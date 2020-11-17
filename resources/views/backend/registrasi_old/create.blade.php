@extends('layouts.backend.master-backend')

@section('title')
Formulir Registrasi
@endsection

@section('content')

<div class="container">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div data-validate="#form-client" data-target="#card-client" id="card-client-step" class="card-move card bg-info card-accent-primary">
                            <div class="card-body text-center">
                                <h5>1. Detail Client</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-validate="#form-client" data-target="#card-pekerjaan" id="card-pekerjaan-step" class="card-move card card-accent-primary">
                            <div class="card-body text-center">
                                <h5>2. Detail Pekerjaan</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-validate="#form-pekerjaan" data-target="#card-pembayaran" id="card-pembayaran-step" class="card-move card card-accent-primary">
                            <div class="card-body text-center">
                                <h5>3. Detail Pembayaran</h5>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card sembunyi bg-danger text-light" id="errorInputDiv">
                    <div class="card-body" id="errorInput">
                    </div>
                </div>
                {{-- form client --}}
                @include('backend.registrasi._form-client')

                {{-- form pekerjaan --}}
                @include('backend.registrasi._form-pekerjaan')

                {{-- form pembayaran --}}
                @include('backend.registrasi._form-pembayaran')
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')

<link rel="stylesheet" href="{{ asset('lib/sweetalert2-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
@include('backend.registrasi.scripts')
@endpush