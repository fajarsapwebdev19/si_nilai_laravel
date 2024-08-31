@extends('dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12 mb-4">
        <h6>Dashboard</h6>
        <b>Selamat Datang, {{$userData->nama}}</b>
      </div>
      <div class="col-12 col-md-12">
        <div class="row">
          <div class="col-md-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <h4 class="fas fa-user-tie"></h4>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Siswa</span>
                <h4 class="card-title mb-2">{{$siswa}}</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <h4 class="fas fa-user-graduate"></h4>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Guru</span>
                <h4 class="card-title mb-2">{{$guru}}</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <h4 class="fas fa-school"></h4>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Rombel</span>
                <h4 class="card-title mb-2">{{$kelas}}</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <h4 class="fas fa-user"></h4>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Pengguna</span>
                <h4 class="card-title mb-2">{{$pengguna}}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <h5>Jumlah Siswa Perkelas</h5>
            </div>
          </div>
          <div class="card-body">
            <div id="siswa-count-chart"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div id="pesan"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('pageTitle', 'Dashboard')
