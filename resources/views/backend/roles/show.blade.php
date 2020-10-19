@extends('layouts.backend.master-backend')
@section('title')
Detail Role
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>Detail Role</strong>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}"> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <table class="table table-responsive">
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>{{ $role->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Permission</strong></td>
                                            @if(!empty($rolePermissions))
                                            <td>
                                                @foreach($rolePermissions as $v)
                                                <label class="badge badge-success">{{ $v->name }}</label>
                                                @endforeach
                                            </td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection