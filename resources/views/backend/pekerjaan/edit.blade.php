@extends('layouts.backend.master-backend')

@section('title')
Ubah Pekerjaan
@endsection

@section('content')

<div class="container">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Ubah Pekerjaan</h4>
                        <a class="d-flex align-items-center btn btn-primary" href="{{ route('pekerjaan.index') }}">Kembali</a>
                    </div>
                    {!! Form::model($dataPekerjaan, ['method' => 'PATCH','route' => ['pekerjaan.update', $dataPekerjaan->id]]) !!}
                    <div class="card-body">
                        @include('backend.pekerjaan._form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-danger btn-sm mx-2">Reset Form</button>
                        <button type="submit" class="btn btn-primary btn-sm" >Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection