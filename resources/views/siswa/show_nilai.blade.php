<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="">Nama</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{$s->nama}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="">Kelas</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{$k->nama_rombel}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="">Tahun Ajaran</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{$tahun_ajaran}} {{$smt}} ({{$semester}})" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <th>KKM</th>
                            <th>P</th>
                            <th>K</th>
                            <th>NA</th>
                            <th>Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mp as $index => $m)
                                @php
                                    $nilaiMapel = $nilai->where('mapel_id', $m->id)->first();
                                    $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                                    $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                                    $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                                    $predikat = $nilaiAkhir >= $m->kkm + 20 ? 'A+' :
                                                ($nilaiAkhir >= $m->kkm + 10 ? 'A' :
                                                ($nilaiAkhir >= $m->kkm ? 'B' :
                                                ($nilaiAkhir >= $m->kkm - 10 ? 'C' : 'D')));
                                @endphp
                            <tr>
                                <td>{{$m->nama_mapel}}</td>
                                <td>{{$m->kkm}}</td>
                                <td>{{$pengetahuan}}</td>
                                <td>{{$keterampilan}}</td>
                                <td>{{$nilaiAkhir}}</td>
                                <td>
                                    @if($nilaiAkhir == 0)
                                    -
                                    @else
                                    {{$predikat}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
