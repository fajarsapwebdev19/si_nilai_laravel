{{-- Modal Tambah Data Mapel --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Mapel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="tambah-mapel">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Kelompok</label>
                        <input type="text" name="kelompok" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kode</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="nama_mapel" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tingkat</label>
                        <select name="tingkat" class="form-control">
                            <option value="">Pilih</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Keahlian</label>
                        <select name="jurusan" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($k as $j)
                                <option value="{{$j->id}}">{{$j->nama_kejuruan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">KKM</label>
                        <input type="number" name="kkm" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Urutan</label>
                        <input type="number" name="urutan" class="form-control">
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

{{-- Ubah Data Mapel --}}
<div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Mapel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="ubah-mapel">

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Mapel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="hapus-mapel">

            </form>
        </div>
    </div>
</div>

{{-- Import Data Kejuruan --}}
<div class="modal fade" id="import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Data Mapel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="import-mapel" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        Untuk Template Import Silahkan Unduh Pada Menu Pusat Unduhan
                    </div>
                    <div id="error-message"></div>
                    <div class="form-group mb-3">
                        <label for="">File Excel</label>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <span>Ext : .xlx, .xlxs</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-success import">Import</button>
                    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
