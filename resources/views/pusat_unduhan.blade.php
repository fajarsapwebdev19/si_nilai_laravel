@extends('dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 mb-4">
          <h6>Pusat Unduhan</h6>

          <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="fas fa-file-excel text-success"></h1>
                        <h5>Template Import Data Kejuruan</h5>
                        <button type="button" class="btn btn-primary unduh" data-url="{{asset('assets/template-import/template-kejuruan.xlsx')}}">
                            <em class="fas fa-download"></em> Download
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="fas fa-file-excel text-success"></h1>
                        <h5>Template Import Data Mapel</h5>
                        <button type="button" class="btn btn-primary unduh" data-url="{{asset('assets/template-import/template-mapel.xlsx')}}">
                            <em class="fas fa-download"></em> Download
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="fas fa-file-excel text-success"></h1>
                        <h5>Template Import Data Siswa</h5>
                        <button type="button" class="btn btn-primary unduh" data-url="{{asset('assets/template-import/template-siswa.xlsx')}}">
                            <em class="fas fa-download"></em> Download
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="fas fa-file-excel text-success"></h1>
                        <h5>Template Import Data Guru</h5>
                        <button type="button" class="btn btn-primary unduh" data-url="{{asset('assets/template-import/template-guru.xlsx')}}">
                            <em class="fas fa-download"></em> Download
                        </button>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('pageTitle', 'Pusat Unduhan')
