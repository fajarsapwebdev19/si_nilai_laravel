@extends('guru.home')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 mb-4">
          <h6>Cetak Raport</h6>

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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{$s->nama}}</td>
                                    <td>
                                        <button class="btn btn-success"><em class="fas fa-print"> </em> Cover</button>
                                        <button class="btn btn-success"><em class="fas fa-print"> </em> Profil Sekolah</button>
                                        <button class="btn btn-success"><em class="fas fa-print"> </em> Identitas</button>
                                        <button class="btn btn-success"><em class="fas fa-print"> </em> Raport</button>
                                        <button class="btn btn-success"><em class="fas fa-print"> </em> Ekskul</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageTitle', 'Cetak Raport')
