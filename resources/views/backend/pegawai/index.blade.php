@extends('layouts.backend.master-backend')

@section('title')
Divisi
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg">
                    <div class="card-header d-flex-align-items-center pb-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item float-left">
                                <h4><i class="c-icon cil-menu"></i> Daftar Divisi</h4>
                            </li>
                            <li class="list-inline-item float-right">
                                <div class="d-none d-md-block">
                                    <a href="{{ route('divisi.create') }}" class="btn btn-sm btn-primary mb-3 mr-auto">
                                        <i class="c-icon cil-plus"></i>
                                        Divisi
                                    </a>
                                </div>
                                <div class="d-md-none float-right">
                                    <a href="{{ route('divisi.create') }}" class="btn btn-sm btn-primary mb-3">
                                        <i class="c-icon cil-plus"></i>

                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="row mb-3">
                                <div class="col-lg-12 d-inline-flex justify-content-end align-items-center">
                                    <input type="text" class="form-control col-lg-3" name="term" placeholder="Pencarian Slider">
                                    <button type="submit" class="btn btn-sm btn-outline-primary mx-1"><i class="c-icon cil-search"></i></a>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-lg-12">
                                @include('backend.divisi._table')
                                {!! $divisi->appends(request()->except('page'))->links() !!}
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
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                fields: {
                    _method: 'DELETE',
                },
                errorMessage: '',
                hasError: false,

            }
        },
        methods: {
            hapus: function(url) {
                window.Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data tidak bisa dikembalikan setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .post(url, this.fields)
                            .then((response) => {
                                if (response.data.code === 500) {
                                    this.hasError = true;
                                    this.errorMessage = response.data.message;
                                } else if (response.data.code === 200) {

                                    window.Swal.fire({
                                        title: 'Berhasil Terhapus!',
                                        message: response.data.message,
                                        icon: 'success',
                                        timer: 1000,
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                    }).then(() => {
                                        location.reload()
                                    });


                                }

                            })
                            .catch((error) => {
                                if (error.response.status === 422) {
                                    this.errors = error.response.data.errors || {};
                                }
                            });
                    }
                })

            },
            showImage: function(link) {

                    window.Swal.fire({
                        imageUrl: link,
                        width: 600,
                        padding: '3em',
                    })
            }
        }
    });
</script>
@endpush