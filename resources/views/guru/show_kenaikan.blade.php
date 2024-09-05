<div class="row">
    <div class="col-md-4">
        <div class="alert alert-info">
            <span>Tahun Ajaran : {{$tapel}}</span>
            <br>
            <span>Kelas : {{$nama_kelas}}</span>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($smt == 1)
            <form id="catatan-wakel">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Catatan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        <input type="hidden" name="tahun_ajaran" value="{{$tapel}}">
                        <input type="hidden" name="smt" value="{{$smt}}">
                        <input type="hidden" name="class_id" value="{{$classId}}">
                        @foreach ($siswa as $s)
                            <tr>
                                <td>
                                    <input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                                    {{$s->nama}}
                                </td>
                                <td>{{$s->jenis_kelamin}}</td>
                                <td>
                                    <input type="hidden" name="status[]" value="">
                                    <textarea name="catatan[]" class="form-control" rows="5">{{$s->deskripsi}}</textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3 simpan">Simpan</button>
            </form>
        @else
            <form id="catatan-wakel">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Status Kenaikan</th>
                            <th>Catatan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        <input type="hidden" name="tahun_ajaran" value="{{$tapel}}">
                        <input type="hidden" name="smt" value="{{$smt}}">
                        <input type="hidden" name="class_id" value="{{$classId}}">
                        @foreach ($siswa as $s)
                            <tr>
                                <td>
                                    <input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                                    {{$s->nama}}
                                </td>
                                <td>{{$s->jenis_kelamin}}</td>
                                <td>
                                    <select name="status[]" class="form-control" style="width: 35%;">
                                        <option value="" {{$s->status_kenaikan == "" ? "selected" : ""}}>-</option>
                                        <option {{$s->status_kenaikan == "Ya" ? "selected" : ""}}>Ya</option>
                                        <option {{$s->status_kenaikan == "Tidak" ? "selected" : ""}}>Tidak</option>
                                    </select>
                                </td>
                                <td><textarea name="catatan[]" class="form-control" rows="5"></textarea></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3 simpan">Simpan</button>
            </form>
        @endif
    </div>
</div>
