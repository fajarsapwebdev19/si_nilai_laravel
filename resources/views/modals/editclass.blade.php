@csrf;
<div class="modal-body">
    <input type="hidden" id="id" value="{{$kelas->id}}">
    <div class="form-group mb-3">
        <label for="" class="form-label">Nama Rombel</label>
        <input type="text" name="nama_rombel" class="form-control" value="{{$kelas->nama_rombel}}">
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Tingkat</label>
        <select name="tingkat" class="form-control">
            <option value="">Pilih</option>
            <option {{ $kelas->tingkat == 10 ? 'selected' : ''}}>10</option>
            <option {{ $kelas->tingkat == 11 ? 'selected' : ''}}>11</option>
            <option {{ $kelas->tingkat == 12 ? 'selected' : ''}}>12</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Keahlian</label>
        <select name="jurusan" class="form-control">
            <option value="">Pilih</option>
            @foreach ($kejuruan as $k)
                <option value="{{$k->id}}" {{$k->id == $kelas->jurusan_id ? 'selected' : ''}}>{{$k->nama_kejuruan}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Status</label>
        <div class="mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_edit_class_1" value="y" {{$kelas->status == "y" ? 'checked' : ''}}>
                <label class="form-check-label" for="status_edit_class_1">Aktif</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_edit_class_2" value="n" {{$kelas->status == "n" ? 'checked' : ''}}>
                <label class="form-check-label" for="status_edit_class_2">Tidak Aktif</label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
</div>
