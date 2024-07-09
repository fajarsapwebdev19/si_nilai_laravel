<div class="modal fade" id="pilih" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Wali Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="pilih-wakel">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="class_id" id="class_id" class="form-control">
                    <div class="mb-3">
                        <label for="">Guru Walas</label>
                        <select name="guru_id" class="form-control">
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
