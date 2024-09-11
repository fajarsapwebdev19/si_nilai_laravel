@extends('dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h6>Master Data <span class="fas fa-arrow-right"></span> Jurusan</h6>
        </div>
      <div class="col-md-12 mb-4">
        <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success mb-3">
            Tambah
        </button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#import" class="btn btn-info mb-3">
            Import
        </button>

        <div class="messages"></div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table kejuruan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kejuruan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
      </div>
      @include('modals/kejuruan')
    </div>
</div>
@endsection

@section('pageTitle', 'Data Kejuruan')
