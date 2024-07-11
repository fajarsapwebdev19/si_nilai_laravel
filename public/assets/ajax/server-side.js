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
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

// data guru
var data_guru = $('.teacher').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'data_guru',
    columns:[
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'personal_data.nama', name: 'personal_data.nama'},
        { data: 'personal_data.jenis_kelamin', name: 'personal_data.jenis_kelamin'},
        { data: 'nik', name: 'nik'},
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

// data siswa
var data_siswa = $('.student').DataTable({
    serverSide: true,
    processing: true,
    ajax: "data_siswa",
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'personal_data.nama', name: 'personal_data.nama'},
        {data: 'personal_data.jenis_kelamin', name: 'personal_data.jenis_kelamin'},
        {data: 'siswa.nisn', name: 'siswa.nisn'},
        {data: 'siswa.tingkat', name: 'siswa.tingkat'},
        {data: 'status_account', name: 'status_account'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
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

// get siswa in class_id

function get_class_id(class_id) {
    if ($.fn.DataTable.isDataTable('.no-class')) {
        $('.no-class').DataTable().destroy();
    }
    if ($.fn.DataTable.isDataTable('.student-class')) {
        $('.student-class').DataTable().destroy();
    }

    var student_no_class = $('.no-class').DataTable({
        processing: true,
        serverSide: true,
        ajax: "get_student_level/" + class_id,
        columns:[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            {data: 'nisn', name: 'nisn'},
            {data: 'nama', name: 'nama'}
        ]
    });

    var student_get_class = $('.student-class').DataTable({
        processing: true,
        serverSide: true,
        ajax: "get_student_class/" + class_id,
        columns:[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            {data: 'nisn', name: 'nisn'},
            {data: 'nama', name: 'nama'}
        ]
    });
}

let wakel = $('.wakel').DataTable({
    processing: true,
    serverSide: true,
    ajax: "get_kelas_wakel",
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama_rombel', name: 'name_rombel'},
        {data: 'tingkat', name: 'tingkat'},
        {data: 'nama', name: 'nama'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});
