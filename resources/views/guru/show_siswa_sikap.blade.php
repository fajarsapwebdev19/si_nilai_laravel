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
                                    <option value=""> - </option>
                                    <option value="A"> Sangat aktif dalam ibadah dan kegiatan spiritual lainnya </option>
                                    <option value="B"> Aktif dalam ibadah, kadang kurang konsisten </option>
                                    <option value="C"> Terkadang aktif dalam ibadah, perlu motivasi lebih </option>
                                    <option value="D"> Jarang mengikuti ibadah, perlu peningkatan motivasi </option>
                                </select>
                            </td>
                            <td>
                                <select name="sosial[]" class="form-control">
                                    <option value=""> - </option>
                                    <option value="A"> Selalu menunjukkan sikap sopan santun </option>
                                    <option value="B"> Biasanya sopan, kadang kurang perhatian </option>
                                    <option value="C"> Kadang tidak sopan dalam interaksi </option>
                                    <option value="D"> Sering menunjukkan sikap tidak sopan </option>
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
