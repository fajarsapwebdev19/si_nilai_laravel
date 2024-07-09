@extends('dash')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <h6>Pengaturan <span class="fas fa-arrow-right"></span> Wali Kelas</h6>

                <div class="messages"></div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover wakel">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Rombel</th>
                                        <th>Tingkat</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                @include('modals/set_wakel')
            </div>
        </div>
    </div>
@endsection
