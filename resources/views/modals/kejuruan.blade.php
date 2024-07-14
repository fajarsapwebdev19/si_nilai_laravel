{{-- Modal Tambah Data --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Kejuruan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form id="tambah-kejuruan">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="">Nama Kejuruan</label>
                        <input type="text" name="nama_kejuruan" class="form-control">
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Kejuruan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form id="ubah-kejuruan">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="">Nama Kejuruan</label>
                        <input type="text" name="nama_kejuruan" class="form-control">
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

{{-- Modal Hapus Data --}}
<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Kejuruan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form id="hapus-kejuruan">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                   <p class="text-center">
                        Apakah anda yakin ingin hapus ? <span id="j"></span>
                        <br><br>
                        <button type="button" class="btn btn-lg btn-success yes">Ya</button>
                        <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Tidak</button>
                   </p>
                </div>
           </form>
        </div>
    </div>
</div>
