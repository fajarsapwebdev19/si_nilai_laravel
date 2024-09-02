<div class="card">
    <div class="card-body">
        <form id="nilai-sikap">
            @csrf
            <input type="hidden" name="class_id" value="{{$class}}">
            <input type="hidden" name="tahun_ajaran" value="{{$ta}}">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Spiritual</th>
                        <th>Sosial</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $s)
                        <tr>
                            <td>{{$s->nama}}</td>
                            <td>
                                <input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                                <select name="spiritual[]" id="" class="form-control">
                                    <option value="" {{$s->spiritual == "" ? "selected" : ""}}> - </option>
                                    <option value="A" {{$s->spiritual == "A" ? "selected" : ""}}> Sangat aktif dalam ibadah dan kegiatan spiritual lainnya </option>
                                    <option value="B" {{$s->spiritual == "B" ? "selected" : ""}}> Aktif dalam ibadah, kadang kurang konsisten </option>
                                    <option value="C" {{$s->spiritual == "C" ? "selected" : ""}}> Terkadang aktif dalam ibadah, perlu motivasi lebih </option>
                                    <option value="D" {{$s->spiritual == "D" ? "selected" : ""}}> Jarang mengikuti ibadah, perlu peningkatan motivasi </option>
                                </select>
                            </td>
                            <td>
                                <select name="sosial[]" class="form-control">
                                    <option value="" {{$s->sosial == "" ? "selected" : ""}}> - </option>
                                    <option value="A" {{$s->sosial == "A" ? "selected" : ""}}> Selalu menunjukkan sikap sopan santun </option>
                                    <option value="B" {{$s->sosial == "B" ? "selected" : ""}}> Biasanya sopan, kadang kurang perhatian </option>
                                    <option value="C" {{$s->sosial == "C" ? "selected" : ""}}> Kadang tidak sopan dalam interaksi </option>
                                    <option value="D" {{$s->sosial == "D" ? "selected" : ""}}> Sering menunjukkan sikap tidak sopan </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success mt-3 simpan">Simpan</button>
        </form>
    </div>
</div>
