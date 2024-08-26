<div class="row">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Naik Kelas</th>
                        <th>Catatan Wali Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $s)
                    <tr>
                        <td>{{$s->nama}}</td>
                        <td><select name="" id="" class="form-control">
                            <option value="">-</option>
                            <option>Ya</option>
                            <option>Tidak</option>
                        </select></td>
                        <td>
                            <textarea name="" id="" cols="5" rows="5" class="form-control"></textarea>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
