<div class="modal fade" id="pilih" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Guru Mapel : <span class="mapel_name"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="pilih-guru-mapel" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="error-message"></div>
                    <div class="form-group mb-3">
                        <input type="hidden" name="class_id">
                        <input type="hidden" name="mapel_id">
                        <label for="">Guru</label>
                        <select name="guru_id" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($guru as $g)
                                <option value="{{$g->id}}">{{$g->personalData->nama}}</option>
                            @endforeach
                        </select>
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
