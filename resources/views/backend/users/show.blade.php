@extends('layouts.backend.master-backend')
@section('title')
Profile User
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header">
                        <div class="float-left">
                            <strong>Profile User</strong>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <tr>
                                <td rowspan="4" width="20%">
                                    <img class="img-avatar" src="{{ asset('img/profile.png') }}" alt="User" width="150" height="150">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush