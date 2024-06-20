{{-- Modal Tambah Data --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tambah-guru">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">NIK</label>
                        <input type="number" name="nik" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">NUPTK</label>
                        <input type="number" name="nuptk" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Jenis Kelamin</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_1" value="L">
                                <label class="form-check-label" for="gender_1">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_2" value="P">
                                <label class="form-check-label" for="gender_2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tempat Lahir</label>
                        <input type="text" name="t_lahir" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jenis PTK</label>
                        <select name="jenis_ptk" class="form-control">
                            <option value="NULL">-- Pilih Jenis PTK --</option>
                            <option>Guru Kelas</option>
                            <option>Guru Mata Pelajaran</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Status Walas</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sts_wls" id="wls_1" value="Y">
                                <label class="form-check-label" for="wls_1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sts_wls" id="wls_2" value="N">
                                <label class="form-check-label" for="wls_2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="2"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control">
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

{{-- Modal Ubah Data --}}
<div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Akun Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ubah-akun">

            </form>
        </div>
    </div>
</div>

{{-- Modal Hapus Data --}}
<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Akun Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="hapus-akun">

            </form>
        </div>
    </div>
</div>
