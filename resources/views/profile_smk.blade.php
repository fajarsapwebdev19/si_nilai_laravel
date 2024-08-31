@csrf
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Tahun Ajaran</label>
    </div>
    <div class="col-md-10">
        <select name="tahun_ajaran" class="form-control">
            <option value="">Pilih</option>
            @foreach ($th as $t)
                {
                <option {{ $p->th_aktif == $t->tahun ? 'selected' : '' }}> {{ $t->tahun }}</option>
                }
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Nama Sekolah</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="nama_sekolah" class="form-control" value="{{ $p->nama_sekolah }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">NPSN</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="npsn" class="form-control" value="{{ $p->npsn }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Alamat</label>
    </div>
    <div class="col-md-10">
        <textarea name="alamat" cols="30" rows="2" class="form-control">{{ $p->alamat }}</textarea>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Kelurahan</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="kelurahan" class="form-control" value="{{ $p->kelurahan }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Kecamatan</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="kecamatan" class="form-control" value="{{ $p->kecamatan }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Kabupaten / Kota</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="kab_kot" class="form-control" value="{{ $p->kab_kot }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Provinsi</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="provinsi" class="form-control" value="{{ $p->provinsi }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Kode Pos</label>
    </div>
    <div class="col-md-10">
        <input type="text" name="kode_pos" class="form-control" value="{{ $p->kode_pos }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Kepala Sekolah</label>
    </div>
    <div class="col-md-10">
        <select name="kep_id" id="" class="form-control">
            <option value="">-- Pilih Kepala Sekolah --</option>
            @foreach ($ks as $k)
                <option {{ $k->id == $p->kep_id ? 'selected' : '' }} value="{{ $k->id }}">
                    {{ $k->personalData->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2">
        <label for="">Logo Sekolah</label>
    </div>
    <div class="col-md-10">
        <input type="file" name="logo_sekolah" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-10 offset-md-2">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success simpan">
                Simpan
            </button>
        </div>
    </div>
</div>

