@extends('layouts.backend.master-backend')

@section('title')
Tambah Divisi
@endsection

@section('content')

<div class="container">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Tambah Divisi</h4>
                        <a class="d-flex align-items-center btn btn-primary" href="{{ route('divisi.index') }}">Kembali</a>
                    </div>
                   {!! Form::open(array('route' => 'divisi.store','method'=>'POST')) !!}
                    <div class="card-body">
                        @include('backend.divisi._form', [ 'url' =>route('divisi.store'), 'method' => 'POST'])
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