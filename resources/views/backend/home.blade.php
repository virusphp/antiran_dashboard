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
                  <h3>{{ $registrasi['rawat_jalan'] }}</h3>
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
        
          <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-orange">
              <div class="card-body pb-0">
                <div class="text-box">
                  <h3>{{ $registrasi['rawat_inap'] }}</h3>
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
        
          <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-pink">
              <div class="card-body pb-0">
                <div class="text-box">
                  <h3>{{ $registrasi['rawat_darurat'] }}</h3>
                </div>
                <div class="icon">
                  <i class="fa fa-ambulance"></i>
                </div>
              </div>
              <div class="text-box-footer">
                  <p>Rawat Darurat</p>
              </div>
            </div>
          </div>
        
          <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-abu">
              <div class="card-body pb-0">
                <div class="text-box">
                  <h3>{{ $registrasi['total'] }}</h3>
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
@push('css')
<link rel="stylesheet" href="{{ asset('toast/jquery.toast.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('toast/jquery.toast.js') }}"></script>
{{-- <script src="{{ asset('coreui/js/main.js') }}"></script> --}}
<script type="text/javascript">
  $(function() {
  @if(Session::has('message'))
    $(document).ready(function() {         
        var type = "{{ Session::get('type') }}";
        switch(type){
          case 'info':
              Toast.fire({
                type : "info",
                title : "{{ Session::get('message') }}"
              });
              break;              
          case 'warning':
              Toast.fire({
              type : "warning",
                title : "{{ Session::get('message') }}"
              });
              break;
          case 'success':
              Toast.fire({
              type : "success",
                title : "{{ Session::get('message') }}"
              });
              break;
          case 'error':
              Toast.fire({
              type : "error",
                title : "{{ Session::get('message') }}"
              });
              break;
        }       
    });
  @endif
}); 
</script>
@endpush