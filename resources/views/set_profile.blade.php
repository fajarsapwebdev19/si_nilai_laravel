@extends('dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <h6>Pengaturan <span class="fas fa-arrow-right"></span> Profil Sekolah</h6>

            <div class="message mb-4"></div>

            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Tahun Ajaran</label>
                            </div>
                            <div class="col-md-10">
                                <select name="tahun-ajaran" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Nama Sekolah</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="nama_sekolah" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">NPSN</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="npsn" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Alamat</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="alamat" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Logo Sekolah</label>
                            </div>
                            <div class="col-md-10">
                                <input type="file" name="logo-sekolah" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-10 offset-md-2">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-success">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
