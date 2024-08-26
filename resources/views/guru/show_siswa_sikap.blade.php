<div class="card">
    <div class="card-body">
        <form id="nilai-sikap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Selalu</th>
                        <th>Meningkat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $s)
                        <tr>
                            <td>{{$s->nama}}</td>
                            <td>
                                <select name="" id="" class="form-control">
                                    <option value=""> - </option>
                                </select>
                            </td>
                            <td>
                                <select name="" id="" class="form-control">
                                    <option value=""> - </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
</div>
