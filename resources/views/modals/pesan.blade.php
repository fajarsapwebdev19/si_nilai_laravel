<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Pesan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="hapus-pesan">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p class="text-center">
                        Apakah Anda Yakin Ingin Hapus Pesan ? <span id="title-message"></span>

                        <br><br>
                        <button type="submit" class="btn btn-success ya">
                            Ya
                        </button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">
                            Tidak
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
