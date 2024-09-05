<div class="row">
    <div class="col-md-4">
        <div class="alert alert-info">
            <span>Tahun Ajaran : {{$ta}}</span>
            <br>
            <span>Kelas : {{$nama_kelas}}</span>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="rekap-absensi-siswa">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Tanpa Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @csrf
                    <input type="hidden" name="class_id" value="{{$classId}}">
                    <input type="hidden" name="tahun_ajaran" value="{{$ta}}">
                    @foreach ($data as $s)
                        <tr>
                            <td><input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                                {{$s->nama}}
                            </td>
                            <td>
                                <input type="text" class="form-control" name="hadir[]" style="width: 40%" value="{{$s->sakit ?? 0}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="izin[]" style="width: 40%" value="{{$s->izin ?? 0}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="tanpa_keterangan[]" style="width: 40%" value="{{$s->tanpa_keterangan ?? 0}}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success simpan mt-3">Simpan</button>
        </form>
    </div>
</div>
