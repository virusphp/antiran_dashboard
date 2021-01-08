@extends('layouts.backend.master-backend')
@section('title')
Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
              
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-hijau">
                    <div class="card-body pb-0">
                      <div class="text-box">
                        {{-- <h3>{{ $bpjs_rajal }}</h3> --}}
                      </div>
                      <div class="icon">
                        <i class="fa fa-stethoscope"></i>
                      </div>
                    </div>
                    <div class="text-box-footer">
                       <p>Rawat Jalan BPJS</p>
                    </div>
                  </div>
                </div>
              
                {{-- <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-ungu">
                    <div class="card-body pb-0">
                      <div class="text-value">{{ $bpjs_rajal }} Pasien</div>
                      <div class="text-value">Rawat Jalan BPJS</div>
                    </div>
                  </div>
                </div> --}}
              
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-orange">
                    <div class="card-body pb-0">
                      <div class="text-box">
                        {{-- <h3>{{ $bpjs_ranap }}</h3> --}}
                      </div>
                      <div class="icon">
                        <i class="fa fa-bed"></i>
                      </div>
                    </div>
                    <div class="text-box-footer">
                       <p>Rawat Inap BPJS</p>
                    </div>
                  </div>
                </div>
              
                {{-- <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-pink">
                    <div class="card-body pb-0">
                      <div class="text-value">{{ $bpjs_ranap }} Pasien</div>
                      <div class="text-value">Rawat Inap BPJS</div>
                    </div>
                  </div>
                </div> --}}
              
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-pink">
                    <div class="card-body pb-0">
                      <div class="text-box">
                        {{-- <h3>{{ $umum }}</h3> --}}
                      </div>
                      <div class="icon">
                        <i class="fa fa-ambulance"></i>
                      </div>
                    </div>
                    <div class="text-box-footer">
                       <p>Rawat Jalan Umum</p>
                    </div>
                  </div>
                </div>
              
                {{-- <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-warning">
                    <div class="card-body pb-0">
                      <div class="text-value">{{ $umum }} Pasien</div>
                      <div class="text-value">Total Pasien Umum</div>
                    </div>
                  </div>
                </div> --}}
              
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-abu">
                    <div class="card-body pb-0">
                      <div class="text-box">
                        {{-- <h3>{{ $bpjs_rajal + $bpjs_ranap + $bpjs_radar }}</h3> --}}
                      </div>
                      <div class="icon">
                        <i class="fa fa-building"></i>
                      </div>
                    </div>
                    <div class="text-box-footer">
                       <p>Total pasien BPJS</p>
                    </div>
                  </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('coreui/js/main.js') }}"></script>
@endpush