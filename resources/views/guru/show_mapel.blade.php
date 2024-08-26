<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Tingkat</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapel as $m)
                    <tr>
                        <td>{{$m->nama_mapel}}</td>
                        <td>{{$m->tingkat}}</td>
                        <td>{{$m->nama_kejuruan}}</td>
                        <td><button class="btn btn-success btn-sm">Nilai</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
