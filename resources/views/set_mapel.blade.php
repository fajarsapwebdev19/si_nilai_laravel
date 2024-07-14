@extends('dash')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <h6>Pengaturan <span class="fas fa-arrow-right"></span> Mapel</h6>

                <div class="messages"></div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover gm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelompok</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th>Keahlian</th>
                                        <th>Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                @include('modals/set_mapel')
            </div>
        </div>
    </div>
@endsection
