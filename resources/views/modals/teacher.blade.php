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
                        <input type="number" name="nik" class="form-control 16-length">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">NUPTK</label>
                        <input type="number" name="nuptk" class="form-control 16-length">
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
                        <input type="text" name="tgl_lahir" class="form-control tanggal">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jenis PTK</label>
                        <select name="jenis_ptk" class="form-control">
                            <option value="NULL">-- Pilih Jenis PTK --</option>
                            <option>Guru Kelas</option>
                            <option>Guru Mata Pelajaran</option>
                            <option>Kepala Sekolah</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="2"></textarea>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ubah-guru">

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
            <form id="hapus-guru">

            </form>
        </div>
    </div>
</div>

{{-- Import Data Siswa --}}
<div class="modal fade" id="import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Data Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="import-guru" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="error-message"></div>
                    <div class="alert alert-info">
                        Untuk Template Import Silahkan Unduh Pada Menu Pusat Unduhan
                    </div>
                    <div class="form-group mb-3">
                        <label for="">File Excel</label>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <span>Ext : .xlx, .xlxs</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-success import">Import</button>
                    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data Pengguna Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-success download-users-teacher">Download</button>
                <table class="table pengguna-guru nowrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Jenis PTK</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
