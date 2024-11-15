{{-- Modal Tambah Data --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tambah-siswa" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">NISN</label>
                                <input type="number" name="nisn" class="form-control 10-length">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">NIK</label>
                                <input type="number" name="nik" class="form-control 16-length">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Kelamin</label>
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
                                <input type="text" name="t_lhr" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tanggal Lahir</label>
                                <input type="text" name="tgl_lhr" class="form-control tanggal">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Keahlian</label>
                                <select name="jurusan" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($keahlian as $k)
                                        <option value="{{$k->id}}">{{$k->nama_kejuruan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">RT</label>
                                <input type="text" name="rt" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">RW</label>
                                <input type="text" name="rw" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kode POS</label>
                                <input type="text" name="kode_pos" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Anak Ke</label>
                                <input type="text" name="anak_ke" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Agama</label>
                                <select name="agama" class="form-control agm"></select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pendidikan Ayah</label>
                                <select name="pendidikan_ayah" class="form-control p_ayah"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pekerjaan Ayah</label>
                                <select name="pekerjaan_ayah" class="form-control pkj_ayah"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pendidikan Ibu</label>
                                <select name="pendidikan_ibu" class="form-control p_ibu"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pekerjaan Ibu</label>
                                <select name="pekerjaan_ibu" class="form-control pkj_ibu"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tingkat</label>
                                <select name="tingkat" class="form-control tkt">
                                    {{-- <option value="">Pilih Tingkat</option>
                                    @foreach ($tingkat as $t)
                                        <option value="{{$t->tingkat}}">{{$t->tingkat}}</option>
                                    @endforeach --}}
                                </select>
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
{{-- Modal Ubah Data --}}
<div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ubah-siswa" autocomplete="off">
                @csrf
                <input type="hidden" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">NISN</label>
                                <input type="number" name="nisn" class="form-control 10-length">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">NIK</label>
                                <input type="number" name="nik" class="form-control 16-length">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Kelamin</label>
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
                                <input type="text" name="t_lhr" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tanggal Lahir</label>
                                <input type="text" name="tgl_lhr" class="form-control tanggal">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Keahlian</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">RT</label>
                                <input type="text" name="rt" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">RW</label>
                                <input type="text" name="rw" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Kode POS</label>
                                <input type="text" name="kode_pos" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Anak Ke</label>
                                <input type="text" name="anak_ke" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Agama</label>
                                <select name="agama" class="form-control" id="agm"></select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for="">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pendidikan Ayah</label>
                                <select name="pendidikan_ayah" id="p_ayah" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pekerjaan Ayah</label>
                                <select name="pekerjaan_ayah" id="pkj_ayah" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pendidikan Ibu</label>
                                <select name="pendidikan_ibu" id="p_ibu" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Pekerjaan Ibu</label>
                                <select name="pekerjaan_ibu" id="pkj_ibu" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tingkat</label>
                                <select name="tingkat" class="form-control" id="tkt">
                                    {{-- <option value="">Pilih Tingkat</option>
                                    @foreach ($tingkat as $t)
                                        <option value="{{$t->tingkat}}">{{$t->tingkat}}</option>
                                    @endforeach --}}
                                </select>
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

{{-- Modal Konfirmasi Hapus Data Siswa --}}
<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="hapus-siswa" autocomplete="off">
                @csrf
                <input type="hidden" id="id-siswa">
                <div class="modal-body">
                    <p class="text-center">
                        Apakah Anda Yakin Ingin Menghapus Data Siswa ? <span id="nama-siswa"></span>
                        <br><br>
                        <button type="button" class="btn btn-lg btn-success yes">Ya</button>
                        <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
                    </p>
                </div>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="import-siswa" autocomplete="off" enctype="multipart/form-data">
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
