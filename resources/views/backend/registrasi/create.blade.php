@extends('layouts.backend.master-backend')

@section('title')
Formulir Registrasi
@endsection

@section('content')

<div class="container">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                {!! Form::open(array('route' => 'registrasi.store','method'=>'POST')) !!}
                <div class="row">

                    <div class="col-sm-4">
                        <div data-target="#form-client" class="card bg-info card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>1. Detail Client</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-target="#form-pekerjaan" class="card card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>2. Detail Pekerjaan</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div data-target="#form-pembayaran" class="card card-accent-primary move">
                            <div class="card-body text-center">
                                <h5>3. Detail Pembayaran</h5>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- form client --}}
                @include('backend.registrasi._form-client')
                
                {{-- form pekerjaan --}}
                @include('backend.registrasi._form-pekerjaan')

                {{-- form pembayaran --}}
                @include('backend.registrasi._form-pembayaran')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('backend.registrasi.scripts')
@endpush