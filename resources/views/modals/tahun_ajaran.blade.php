{{-- Modal Tambah Data --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Tahun Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="tambah-tahun-ajaran" autocomplete="off">
                @csrf;
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Tahun AJaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Semester</label>
                        <input type="text" name="semester" class="form-control">
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
{{-- End Modal Tambah Data --}}

{{-- Modal Ubah Data --}}
<div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Tahun Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ubah-tahun-ajaran" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Tahun AJaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Semester</label>
                        <input type="text" name="semester" class="form-control">
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
{{-- End Modal Ubah Data --}}

{{-- Modal Ubah Data --}}
<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Tahun Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="hapus-tahun-ajaran" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p class="text-center">
                        Apakah anda yakin ingin hapus data ? <span id="tahunajaran"></span>

                        <br><br>
                        <button type="submit" class="btn btn-success ya">
                            Ya
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Tidak
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Ubah Data --}}
