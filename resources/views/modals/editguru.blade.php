@csrf
<input type="hidden" id="id" value="{{$t->id}}">
<div class="modal-body">
    <div class="form-group mb-3">
        <label for="">NIK</label>
        <input type="number" name="nik" class="form-control 16-length" value="{{$t->guru->nik}}">
    </div>
    <div class="form-group mb-3">
        <label for="">NUPTK</label>
        <input type="number" name="nuptk" class="form-control 16-length" value="{{$t->guru->nuptk}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{$t->personalData->nama}}">
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Jenis Kelamin</label>
        <div class="mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_edit_1" value="L" {{$t->personalData->jenis_kelamin == 'L' ? 'checked' : ''}}>
                <label class="form-check-label" for="gender_edit_1">Laki-Laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender_edit_2" value="P"  {{$t->personalData->jenis_kelamin == 'P' ? 'checked' : ''}}>
                <label class="form-check-label" for="gender_edit_2">Perempuan</label>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="">Tempat Lahir</label>
        <input type="text" name="t_lahir" class="form-control" value="{{$t->guru->tempat_lahir}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Tanggal Lahir</label>
        <input type="text" name="tgl_lahir" class="form-control" value="{{$t->guru->tanggal_lahir}}">
    </div>
    <div class="form-group mb-3">
        <label for="">Jenis PTK</label>
        <select name="jenis_ptk" class="form-control">
            <option value="NULL">-- Pilih Jenis PTK --</option>
            <option {{$t->guru->jenis_ptk == 'Guru Kelas' ? 'selected' : ''}}>Guru Kelas</option>
            <option {{$t->guru->jenis_ptk == 'Guru Mata Pelajaran' ? 'selected' : ''}}>Guru Mata Pelajaran</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Status Walas</label>
        <div class="mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sts_wls" id="wls_e_1" value="Y" {{$t->guru->wali_kelas == 'Y' ? 'checked' : ''}}>
                <label class="form-check-label" for="wls_e_1">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sts_wls" id="wls_e_2" value="N" {{$t->guru->wali_kelas == 'N' ? 'checked' : ''}}>
                <label class="form-check-label" for="wls_e_2">Tidak</label>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="">Kelas</label>
        <select name="kelas_id" id="kelas_id" class="form-control">
            <option value="NULL">-- Pilih Kelas --</option>
            @isset($k)
                @foreach ($k as $kelas)
                    @php
                        $isSelected = ($t->guru->class_id == $kelas->id) ? 'selected' : '';
                    @endphp
                    <option value="{{ $kelas->id }}" {{ $isSelected }}>{{ $kelas->nama_rombel }}</option>
                @endforeach
            @endisset

        </select>
    </div>
    <div class="form-group mb-3">
        <label for="">Alamat</label>
        <textarea name="alamat" class="form-control" cols="30" rows="2">{{$t->personalData->alamat}}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="">Username</label>
        <input type="text" class="form-control" value="{{$t->username}}" readonly>
    </div>
    <div class="form-group mb-3">
        <label for="">Password</label>
        <input type="text" name="password" class="form-control" value="{{$t->real_password}}">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-lg btn-success simpan">Simpan</button>
    <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Batal</button>
</div>
