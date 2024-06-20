@csrf
<input type="hidden" id="id" value="{{$user->id}}">
<div class="modal-body">
  <div class="form-group mb-3">
    <label for="">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{$user->personalData->nama}}">
  </div>
  <div class="form-group mb-3">
    <label for="" class="form-label">Jenis Kelamin</label>
    <div class="mt-2">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_1" value="L" {{$user->personalData->jenis_kelamin == "L" ? "checked" : ""}}>
        <label class="form-check-label" for="gender_1">Laki-Laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_2" value="P" {{$user->personalData->jenis_kelamin == "P" ? "checked" : ""}}>
        <label class="form-check-label" for="gender_2">Perempuan</label>
      </div>
    </div>
  </div>
  <div class="form-group mb-3">
    <label for="">Alamat</label>
    <textarea name="alamat" class="form-control" cols="30" rows="2">{{$user->personalData->alamat}}</textarea>
  </div>
  <div class="form-group mb-3">
    <label for="">Username</label>
    <input type="text" class="form-control" value="{{$user->username}}" readonly>
  </div>
  <div class="form-group mb-3">
    <label for="">Password</label>
    <input type="text" name="password" class="form-control" value="{{$user->real_password}}">
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
  <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
</div>
