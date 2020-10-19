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
                            <h4>Tambah User</h4>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> Back</a>
                        </div>
                    </div>


                    {!! Form::model($user, array('route' => 'users.store','method'=>'POST', 'id' => 'user-form')) !!}

                    @include('backend.users._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection