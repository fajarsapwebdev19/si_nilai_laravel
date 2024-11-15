@extends('dash')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <h6>Master Data <span class="fas fa-arrow-right"></span> Siswa</h6>

                <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success mb-2">
                    Tambah
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#import" class="btn btn-info mb-2">
                    Import
                </button>

                <div class="messages"></div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover student">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>NISN</th>
                                        <th>Tingkat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                @include('modals/student')
            </div>
        </div>
    </div>
@endsection

@section('pageTitle', 'Data Siswa')
