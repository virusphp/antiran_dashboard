@extends('layouts.backend.master-backend')
@section('title')
Data Role
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg">
                    <div class="card-header pb-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item float-left">
                                <h4><i class="c-icon cil-menu"></i> Daftar Role</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon cil-plus mx-2"></i>
                                        Role
                                    </a>
                                </div>
                                <div class="d-md-none float-right">
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary mb-3">
                                        <i class="c-icon cil-plus mx-2"></i>

                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal">
                            <div class="row mb-3">
                                <div class="col-lg-12 d-inline-flex justify-content-end align-items-center align-items-stretch">
                                    <input type="text" class="form-control col-lg-3" id="term" name="term" placeholder="Pencarian">
                                    <button type="submit" class="btn btn-sm btn-outline-primary mx-1"><i class="c-icon cil-magnifying-glass mx-2"></i></a>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-lg-12">
                                @include('backend.roles._table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('backend.roles.scripts')
@endpush
