@extends('layouts.backend.master-backend')
@section('title')
Create Roles
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h4>Create New Role</h4>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>

                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    @include('backend.roles._form')
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('backend.roles.scripts-form')
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('lib/icheck/square/blue.css') }}">
    <style>
        .permissions {
            margin-right: 10px;
        }
    </style>
@endpush