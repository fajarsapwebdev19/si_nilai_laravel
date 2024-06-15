// khusus server side

var account = $(".account").DataTable({

});

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
