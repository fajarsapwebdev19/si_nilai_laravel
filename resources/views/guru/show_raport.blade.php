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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Cetak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $s)
                    <tr>
                        <td>{{$s->nama}}</td>
                        <td>
                            <button type="button" data-user="{{$s->user_id}}" class="btn btn-success cover"><em class="fas fa-print"> </em> Cover</button>
                            <button type="button" class="btn btn-success profil-sekolah"><em class="fas fa-print"> </em> Profil Sekolah</button>
                            <button type="button" data-user="{{$s->user_id}}" class="btn btn-success identitas"><em class="fas fa-print"> </em> Identitas</button>
                            <button type="button" data-user="{{$s->user_id}}" data-tapel="{{$tapel}}" class="btn btn-success raport"><em class="fas fa-print"> </em> Raport</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
