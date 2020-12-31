@extends('layouts.master-login')
@section('title')
Admin Login
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1>{{ __('Login') }}</h1>
                            <p class="text-muted">{{ __('Hi. How are you?') }}</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="c-icon fa fa-user"></i></span></div>
                                <input id="username" name="username" class="form-control @error('username') is-invalid @enderror" type="text" placeholder="Username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="c-icon fa fa-lock"> </i></span></div>
                                <input id="password" name="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" value="{{ old('password') }}" autocomplete="current-password">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="c-icon fa fa-eye-slash" id="password-show"> </i>
                                        <i class="c-icon fa fa-eye sembunyi" id="password-hide"> </i>
                                    </span>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">

                                <div class="col-12 mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-success px-4" type="submit">{{ __('Login') }}</button>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card text-white bg-dark-green py-5 d-md-down-none  flex-row align-items-center" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <img src="{{ asset('img/profile/logo.png') }}" class="img-fluid" alt="logo-big"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#password-hide').hide();

        $("#password-show").click(function() {
            $("#password").attr("type", "text");
            $(this).parent().find("#password-show").hide();
            $(this).parent().find("#password-hide").show();
        });
        $("#password-hide").click(function() {
            $("#password").attr("type", "password");
            $(this).parent().find("#password-hide").hide();
            $(this).parent().find("#password-show").show();
        });
    });
</script>
@endpush