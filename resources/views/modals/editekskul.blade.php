@csrf
<input type="hidden" id="id" value="{{$ekskul->id}}">
<div class="modal-body">
    <div class="form-group mb-2">
        <label for="">Nama Ekstrakulikuler</label>
        <input type="text" name="nama_ekstrakulikuler" class="form-control" value="{{$ekskul->nama_ekstrakulikuler}}">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
</div>
