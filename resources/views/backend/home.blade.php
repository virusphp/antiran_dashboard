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

<div class="align-self-center">
  <div class="row">
    @foreach($pegawaiUltah as $pg)
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-header">
          Selamat Ulang Tahun
        </div>
        <div class="card-body">
          <img src="{{ asset($pg->photo) }}" width="149" height="200"
            alt="{{ $pg->nama_pegawai }}">
          <p>
            <strong>{{ $pg->nama_pegawai }}</strong> <br>
            {{ tanggal($pg->tgl_lahir) }} <br>
            {{ $pg->unit_kerja }}
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
@include('template.toast')
@push('css')
<link href="{{ asset('lib/sweetalert-bootstrap/bootstrap-4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('lib/toastr/toastr.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('lib/toastr/toastr.min.js') }}"></script>
{{-- <script src="{{ asset('coreui/js/main.js') }}"></script> --}}
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      icon: 'success',
      timerProgressBar: true,
      timer: 3000,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    }); 

    @if(Session::has('message'))
      $(document).ready(function() {         
          var type = "{{ Session::get('type') }}";
          switch(type){
            case 'info':
                Toast.fire({
                  type : type,
                  title : "{{ Session::get('message') }}",
                });
                break;              
            case 'warning':
                Toast.fire({
                  type : type,
                  title : "{{ Session::get('message') }}",
                });
                break;
            case 'success':
                Toast.fire({
                  type : type,
                  title : "{{ Session::get('message') }}",
                });
                break;
            case 'error':
                Toast.fire({
                  type : type,
                  title : "{{ Session::get('message') }}",
                });
                break;
          }       
      });
    @endif
}); 
</script>
@endpush