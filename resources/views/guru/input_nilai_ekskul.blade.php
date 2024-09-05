<div class="mt-2">
    <h3>
        Ekskul : {{$nama_ekskul}}
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form id="nilai-ekskul-input">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Nilai</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                        @csrf
                        <input type="hidden" name="class_id" value="{{$classId}}">
                        <input type="hidden" name="tahun" value="{{$tahun}}">
                        <input type="hidden" name="ekskul_id" value="{{$ekskulId}}">
                        @foreach ($data as $s)
                            <tr>
                                <td>
                                    <input type="hidden" name="user_id[]" value="{{$s->user_id}}">
                                    {{$s->nama}}
                                </td>
                                <td>{{$s->jenis_kelamin}}</td>
                                <td>
                                    <select name="nilai[]" class="form-control" style="width: 100%;">
                                        <option value="" {{$s->nilai == "" ? "selected" : ""}}>-</option>
                                        <option {{$s->nilai == "A" ? "selected" : ""}}>A</option>
                                        <option {{$s->nilai == "B" ? "selected" : ""}}>B</option>
                                        <option {{$s->nilai == "C" ? "selected" : ""}}>C</option>
                                        <option {{$s->nilai == "D" ? "selected" : ""}}>D</option>
                                    </select>
                                </td>
                                <td><textarea name="deskripsi[]" class="form-control" rows="3">{{$s->deskripsi}}</textarea></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success simpan mt-2">
                Simpan
            </button>
        </form>
    </div>
</div>
