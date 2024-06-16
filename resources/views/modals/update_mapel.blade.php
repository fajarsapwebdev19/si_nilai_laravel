@csrf
<div class="modal-body">
    <input type="hidden" id="id" value="{{$mapel->id}}">
    <div class="form-group mb-3">
        <label for="">Kelompok</label>
        <input type="text" name="kelompok" class="form-control" value="{{$mapel->kelompok}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Kode</label>
        <input type="text" name="kode" class="form-control" value="{{$mapel->kode}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama_mapel" class="form-control" value="{{$mapel->nama_mapel}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Tingkat</label>
        <select name="tingkat" class="form-control">
            <option value="">Pilih</option>
            <option {{ $mapel->tingkat == "10" ? 'selected' : ''}}>10</option>
            <option {{ $mapel->tingkat == "11" ? 'selected' : ''}}>11</option>
            <option {{ $mapel->tingkat == "12" ? 'selected' : ''}}>12</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="">KKM</label>
        <input type="number" name="kkm" class="form-control" value="{{$mapel->kkm}}">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
</div>
