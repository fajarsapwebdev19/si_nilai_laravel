// khusus server side

var account = $(".account").DataTable({
    processing: true,
    serverSide: true,
    ajax: 'akun_admin',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'personal_data.nama', name: 'personal_data.nama'},
        { data: 'personal_data.jenis_kelamin', name: 'personal_data.jenis_kelamin'},
        { data: 'username', name: 'username'},
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ]
});

// data kelas
var data_kelas = $(".kelas").DataTable({
    processing: true,
    serverSide: true,
    ajax: 'data_kelas',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama_rombel', name: 'nama_rombel'},
        { data: 'tingkat', name: 'tingkat'},
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ]
});

// data mapel
var data_mapel = $(".mapel").DataTable({
    processing: true,
    serverSide: true,
    ajax: 'data_mapel',
    columns: [
        {data : 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data : 'kelompok', name: 'kelompok'},
        {data : 'kode', name: 'kode'},
        {data : 'nama_mapel', name: 'nama_mapel'},
        {data : 'tingkat', name: 'tingkat'},
        {data : 'kkm', name: 'kkm'},
        {data : 'action', name: 'action', orderable: false, searchable: false}
    ]
});

// data ekstrakulikuler
var data_ekskul = $('.ekskul').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'data_ekskul',
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama_ekstrakulikuler', name: 'nama_ekstrakulikuler'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
