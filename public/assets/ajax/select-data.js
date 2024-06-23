let apiUrl1 = "https://masterdata.ppdb.dev19.my.id/api/m_pekerjaan.php";
let apiUrl2 = "https://masterdata.ppdb.dev19.my.id/api/m_pendidikan.php";
let apiUrl3 = "https://masterdata.ppdb.dev19.my.id/api/m_agama.php";

// get data pekerjaan ayah
$.ajax({
    url: apiUrl1,
    method: "GET",
    success: function(response) {
        console.log("API Response:", response); // Log response to inspect structure
        let pekerjaan = response;
        $('.pkj_ayah').append('<option value=""> Pilih Pekerjaan </option>');
        $.each(pekerjaan, function(key, value) {
            $('.pkj_ayah').append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// get data pendidikan ayah
$.ajax({
    url: apiUrl2,
    method: "GET",
    success: function(response) {
        let pendidikan = response;
        $('.p_ayah').append('<option value=""> Pilih Pendidikan </option>');
        $.each(pendidikan, function(key, value) {
            $('.p_ayah').append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// get data pekerjaan ibu
$.ajax({
    url: apiUrl1,
    method: "GET",
    success: function(response) {
        console.log("API Response:", response); // Log response to inspect structure
        let pekerjaan = response;
        $('.pkj_ibu').append('<option value=""> Pilih Pekerjaan </option>');
        $.each(pekerjaan, function(key, value) {
            $('.pkj_ibu').append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// get data pendidikan ayah
$.ajax({
    url: apiUrl2,
    method: "GET",
    success: function(response) {
        let pendidikan = response;
        $('.p_ibu').append('<option value=""> Pilih Pendidikan </option>');
        $.each(pendidikan, function(key, value) {
            $('.p_ibu').append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// agama
$.ajax({
    url: apiUrl3,
    method: "GET",
    success: function(response) {
        let agama = response;
        $('.agm').append('<option value=""> Pilih Agama </option>');
        $.each(agama, function(key, value) {
            $('.agm').append('<option value="' + value.nama_agama + '">' + value.nama_agama + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

$.ajax({
    url: 'get_tingkat',
    method: "GET",
    success: function(response) {
        let tingkat = response;
        $('.tkt').append('<option value=""> Pilih Tingkat </option>');
        $.each(tingkat, function(key, value) {
            $('.tkt').append('<option value="' + value.tingkat + '">' + value.tingkat + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});
