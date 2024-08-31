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
        { data: 'jurusan.nama_kejuruan', name: 'jurusan.nama_kejuruan'},
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
        {data: 'jurusan.nama_kejuruan', name: 'jurusan.nama_kejuruan'},
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
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
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
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'nama', name: 'nama'}
        ]
    });
}

function get_siswa_user(id)
{
    if ($.fn.DataTable.isDataTable('.siswa_users')) {
        $('.siswa_users').DataTable().destroy();
    }

    $('.siswa_users').DataTable({
        processing: true,
        serverSide: true,
        ajax: "get_data_siswa/" + id,
        columns:[
            {data: 'nama', name: 'nama'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'username', name: 'username'},
            {data: 'real_password', name: 'real_password'}
        ]
    });
}

function role_users(role_id){
    if ($.fn.DataTable.isDataTable('.pengguna-guru')) {
        $('.pengguna-guru').DataTable().destroy();
    }

    $('.pengguna-guru').DataTable({
        processing: true,
        serverSide: true,
        ajax: "get_teacher_users/" + role_id,
        columns:[
            {data: 'personal_data.nama', name: 'personal_data.nama'},
            {data: 'personal_data.jenis_kelamin', name: 'personal_data.jenis_kelamin'},
            {data: 'username', name: 'username'},
            {data: 'real_password', name: 'real_password'},
            {data: 'guru.jenis_ptk', name: 'guru.jenis_ptk'}
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

let kejuruan = $('.kejuruan').DataTable({
    processing: true,
    serverSide: true,
    ajax: "data_kejuruan",
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama_kejuruan', name: 'nama_kejuruan'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

let guru_mapel = $('.gm').DataTable({
    processing: true,
    serverSide: true,
    ajax: "data_guru_mapel",
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'mapel.nama_mapel', name: 'mapel.nama_mapel'},
        {data: 'mapel.tingkat', name: 'mapel.tingkat'},
        {data: 'mapel.jurusan.nama_kejuruan', name: 'mapel.jurusan.nama_kejuruan'},
        {data: 'guru.personal_data.nama', name: 'guru.personal_data.nama'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

let tahun_ajaran = $('.th_aj').DataTable({
    processing: true,
    serverSide: true,
    ajax: "data_tahun_ajaran",
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'tahun', name: 'tahun'},
        {data: 'semester', name: 'semester'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
