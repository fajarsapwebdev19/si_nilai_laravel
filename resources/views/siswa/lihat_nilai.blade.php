@extends('siswa.dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <h6>Lihat Nilai</h6>
        </div>

        <div class="row">
            <div class="col-md-4">
                <form id="filter-rekap-absensi">
                    <div class="form-group mb-3">
                        <select name="tahun_ajaran" class="form-control">
                            <option value=""> -- Pilih -- </option>
                            @foreach ($tahun as $t)
                                <option>{{$t->tahun}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success mt-3 filter">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Nama</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$userData->nama}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Kelas</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$kelas->nama_rombel}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>KKM</th>
                                    <th>Nilai</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $m)
                                    <tr>
                                        <td>{{$m->nama_mapel}}</td>
                                        <td>{{$m->kkm}}</td>
                                        <td>80</td>
                                        <th>A</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
