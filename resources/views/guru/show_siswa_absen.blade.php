<div class="card">
    <div class="card-body">
        <form id="rekap-absensi-siswa">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Tanpa Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $s)
                        <tr>
                            <td>{{$s->nama}}</td>
                            <td>
                                <input type="text" class="form-control" style="width: 40%" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control" style="width: 40%" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control" style="width: 40%" value="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
</div>
