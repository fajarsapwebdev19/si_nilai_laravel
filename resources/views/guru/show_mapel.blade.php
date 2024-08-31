<div class="card">
    <div class="card-body">
        <table class="table mapel">
            <thead>
                <tr>
                    <th>Nama Guru</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapel as $m)
                    <tr>
                        <td>{{$m->nama}}</td>
                        <td>{{$m->nama_rombel}}</td>
                        <td>{{$m->nama_mapel}}</td>
                        <td><button type="button" data-kelas="{{$m->nama_rombel}}" data-id="{{$m->mapel_id}}" data-mapel="{{$m->nama_mapel}}" class="btn btn-success btn-sm nilai">Input</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('guru.modals/input')
