<div class="modal-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>JK</th>
                <th width="30">Pengetahuan</th>
                <th width="30">Keterampilan</th>
            </tr>
        </thead>
        @csrf
        <tbody>
            @php
            $no = 1; // Inisialisasi nomor urut
            @endphp
            @foreach ($siswa as $s)
                <tr>

                    <td>
                        <input type="hidden" name="tahun_ajaran[]" value="{{$tapel}}">
                        <input type="hidden" name="mapel_id[]" value="{{$mapelid}}">
                        <input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                        {{ $no++ }}
                    </td>
                    <td>{{$s->nisn}}</td>
                    <td>{{$s->nama}}</td>
                    <td>{{$s->jenis_kelamin}}</td>
                    <td><input type="number" name="np[]" class="form-control" value="{{$s->nilai_pengetahuan ?? 0 }}"></td>
                    <td><input type="number" name="nk[]" class="form-control" value="{{$s->nilai_keterampilan ?? 0 }}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success simpan">
        Simpan
    </button>
</div>
