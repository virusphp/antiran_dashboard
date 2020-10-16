@extends('layouts.backend.master-backend')

@section('title')
Edit Pegawai
@endsection

@section('content')

<div class="container">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Pegawai</h4>
                        <a class="d-flex align-items-center btn btn-primary" href="{{ route('pegawai.index') }}">Kembali</a>
                    </div>
                    {!! Form::model($dataPegawai, ['method' => 'PATCH','route' => ['pegawai.update', $dataPegawai->id]]) !!}
                    <div class="card-body">
                        @include('backend.pegawai._form', [ 'url' => route('pegawai.update',$dataPegawai->id), 'method' => 'PATCH'])
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-danger btn-sm mx-2">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection