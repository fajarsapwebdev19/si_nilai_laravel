@extends('dash')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <h6>Master Data <span class="fas fa-arrow-right"></span> Mapel</h6>

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
                            <table class="table table-hover mapel">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelompok</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th>Keahlian</th>
                                        <th>KKM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                @include('modals/mapel')
            </div>
        </div>
    </div>
@endsection

@section('pageTitle', 'Data Mata Pelajaran')
