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
                        <div data-target="#card-client" id="card-client-step" class="card bg-info card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>1. Detail Client</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-target="#card-pekerjaan" id="card-pekerjaan-step" class="card-move card card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>2. Detail Pekerjaan</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-target="#card-tagihan" id="card-tagihan-step" class="card-move card card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>3. Detail Tagihan</h5>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- form client --}}
                @include('backend.registrasi._form-client')

                {{-- form pekerjaan --}}
                @include('backend.registrasi._form-pekerjaan')

                {{-- form pembayaran --}}
                @include('backend.registrasi._form-tagihan')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('backend.registrasi.scripts')
@endpush