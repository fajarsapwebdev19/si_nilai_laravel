{{-- Modal Tambah Data Kelas --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="tambah-kelas">
                @csrf;
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama Rombel</label>
                        <input type="text" name="nama_rombel" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Tingkat</label>
                        <select name="tingkat" class="form-control">
                            <option value="">Pilih</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Status</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_class_1" value="y">
                                <label class="form-check-label" for="status_class_1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_class_2" value="n">
                                <label class="form-check-label" for="status_class_2">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
                    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Kelas --}}

<div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="ubah-kelas">

            </form>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus Data Kelas --}}
<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="hapus-kelas">

            </form>
        </div>
    </div>
</div>

{{-- Get Siswa Perkelas --}}
<div class="modal fade" id="siswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data Siswa <span class="title-kelas"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="get_siswa">
                <div class="modal-body">
                    <div class="message-class"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table no-class">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="form-check-input all-check-no-class"></th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" id="class_id">
                            <div class="mt-3">
                                <button type="button" class="btn btn-success" id="assign">Simpan</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table student-class">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="form-check-input all-check-class"></th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-danger" id="unassign">Keluarkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
