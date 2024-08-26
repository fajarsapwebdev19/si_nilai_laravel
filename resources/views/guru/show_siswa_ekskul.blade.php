<div class="row">
    <div class="col-md-6">
        <div class="list-group">
            @foreach ($ekskul as $e)
            <button type="button" class="list-group-item list-group-item-action">{{$e->nama_ekstrakulikuler}}</button>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $s)
                            <tr>
                                <td>{{$s->nama}}</td>
                                <td><select name="grade" class="form-control">
                                    <option value="">-</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
