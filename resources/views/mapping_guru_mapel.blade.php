<table class="table">
    <thead>
        <tr>
            <th>Kelompok</th>
            <th>Mata Pelajaran</th>
            <th>Tingkat</th>
            <th>Jurusan</th>
            <th>Nama Guru</th>
            <th>Pilih</th>
        </tr>
        <tbody>
            @foreach ($mapel as $m)
                <tr>
                    <td>{{$m->mapel->kelompok}}</td>
                    <td>{{$m->mapel->nama_mapel}}</td>
                    <td>{{$m->mapel->tingkat}}</td>
                    <td>{{$m->mapel->jurusan->nama_kejuruan}}</td>
                    <td>
                        @if($m->guru && $m->guru->personalData)
                            {{ $m->guru->personalData->nama }}
                        @else
                            <em>Belum Menentukan</em> <!-- Placeholder jika guru atau personalData tidak ada -->
                        @endif
                    </td>
                    <td><button type="button" data-name="{{$m->mapel->nama_mapel}}" data-id="{{$m->class_id}}" data-mapel="{{$m->mapel->id}}" class="btn btn-info btn-sm select-guru">Pilih</button></td>
                </tr>
            @endforeach
        </tbody>
    </thead>
</table>

@include('modals/set_mapel')
