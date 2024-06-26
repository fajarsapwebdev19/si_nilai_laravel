let apiUrl1 = "https://masterdata.ppdb.dev19.my.id/api/m_pekerjaan.php";
let apiUrl2 = "https://masterdata.ppdb.dev19.my.id/api/m_pendidikan.php";
let apiUrl3 = "https://masterdata.ppdb.dev19.my.id/api/m_agama.php";

// selected update data
// pendidikan ibu
function select_pendidikan_ibu(pendidikan_ibu)
{
    $.ajax({
        url: apiUrl2,
        method: "GET",
        success: function(response) {
            let pendidikan = response;

            let p_ibu = $('#p_ibu');
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            p_ibu.empty();
            p_ibu.append('<option value=""> Pilih Pendidikan </option>');
            $.each(pendidikan, function(key, value) {
                if(value.pendidikan == pendidikan_ibu)
                {
                    p_ibu.append('<option value="' + value.pendidikan + '" selected>' + value.pendidikan + '</option>');
                }else{
                    p_ibu.append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pendidikan ayah
function select_pendidikan_ayah(pendidikan_ayah)
{
    $.ajax({
        url: apiUrl2,
        method: "GET",
        success: function(response) {
            let pendidikan = response;
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            let p_ayah = $('#p_ayah');
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            p_ayah.empty();
            p_ayah.append('<option value=""> Pilih Pendidikan </option>');
            $.each(pendidikan, function(key, value) {
                if(value.pendidikan == pendidikan_ayah)
                {
                    p_ayah.append('<option value="' + value.pendidikan + '" selected>' + value.pendidikan + '</option>');
                }else{
                    p_ayah.append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pekerjaan ibu
function select_pekerjaan_ibu(pekerjaan_ibu)
{
    $.ajax({
        url: apiUrl1,
        method: "GET",
        success: function(response) {
            console.log("API Response:", response); // Log response to inspect structure
            let pekerjaan = response;
            let pkj_ibu = $("#pkj_ibu");
            pkj_ibu.append('<option value=""> Pilih Pekerjaan </option>');
            $.each(pekerjaan, function(key, value) {
                if(value.pekerjaan == pekerjaan_ibu)
                {
                    pkj_ibu.append('<option value="' + value.pekerjaan + '" selected>' + value.pekerjaan + '</option>');
                }else{
                    pkj_ibu.append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pekerjaan ayah
function select_pekerjaan_ayah(pekerjaan_ayah)
{
    $.ajax({
        url: apiUrl1,
        method: "GET",
        success: function(response) {
            console.log("API Response:", response); // Log response to inspect structure
            let pekerjaan = response;
            let pkj_ayah = $("#pkj_ayah");
            pkj_ayah.append('<option value=""> Pilih Pekerjaan </option>');
            $.each(pekerjaan, function(key, value) {
                if(value.pekerjaan == pekerjaan_ayah)
                {
                    pkj_ayah.append('<option value="' + value.pekerjaan + '" selected>' + value.pekerjaan + '</option>');
                }else{
                    pkj_ayah.append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}

// agama
function select_agama(agamaselect) {
    $.ajax({
        url: apiUrl3,
        method: "GET",
        success: function(response) {
            let agama = response;
            let selectAgama = $('#agm');

            // Mengosongkan elemen select sebelum menambahkan opsi baru
            selectAgama.empty();

            // Menambahkan opsi default
            selectAgama.append('<option value=""> Pilih Agama </option>');

            // Menambahkan opsi dari respons API
            $.each(agama, function(key, value) {
                if (value.nama_agama == agamaselect) {
                    selectAgama.append('<option value="' + value.nama_agama + '" selected>' + value.nama_agama + '</option>');
                } else {
                    selectAgama.append('<option value="' + value.nama_agama + '">' + value.nama_agama + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}


function select_tingkat(tingkat_select)
{
    $.ajax({
        url: 'get_tingkat',
        method: "GET",
        success: function(response) {
            let tingkat = response;
            let selectTingkat = $("#tkt");
            selectTingkat.empty();
            selectTingkat.append('<option value=""> Pilih Tingkat </option>');
            $.each(tingkat, function(key, value) {
                if(value.tingkat == tingkat_select)
                {
                   selectTingkat.append('<option value="' + value.tingkat + '" selected>' + value.tingkat + '</option>');
                }else{
                   selectTingkat.append('<option value="' + value.tingkat + '">' + value.tingkat + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}

// select
// pekerjaan ayah & ibu
$.ajax({
    url: apiUrl1,
    method: "GET",
    success: function(response) {
        console.log("API Response:", response); // Log response to inspect structure
        let pekerjaan = response;
        let pkj_ayah = $(".pkj_ayah");
        let pkj_ibu = $(".pkj_ibu");
        pkj_ibu.append('<option value=""> Pilih Pekerjaan </option>');
        pkj_ayah.append('<option value=""> Pilih Pekerjaan </option>');
        $.each(pekerjaan, function(key, value) {
            pkj_ibu.append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
            pkj_ayah.append('<option value="' + value.pekerjaan + '">' + value.pekerjaan + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// pendidikan ayah & ibu
$.ajax({
    url: apiUrl2,
    method: "GET",
    success: function(response) {
        let pendidikan = response;
        let p_ibu = $('.p_ibu');
        let p_ayah = $('.p_ayah');
        p_ayah.append('<option value=""> Pilih Pendidikan </option>');
        p_ibu.append('<option value=""> Pilih Pendidikan </option>');
        $.each(pendidikan, function(key, value) {
           p_ayah.append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
           p_ibu.append('<option value="' + value.pendidikan + '">' + value.pendidikan + '</option>');
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
        let selectAgama = $('.agm');

        // Mengosongkan elemen select sebelum menambahkan opsi baru
        selectAgama.empty();

        // Menambahkan opsi default
        selectAgama.append('<option value=""> Pilih Agama </option>');

        // Menambahkan opsi dari respons API
        $.each(agama, function(key, value) {
            selectAgama.append('<option value="' + value.nama_agama + '">' + value.nama_agama + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// tingkat
$.ajax({
    url: 'get_tingkat',
    method: "GET",
    success: function(response) {
        let tingkat = response;
        let selectTingkat = $(".tkt");
        selectTingkat.empty();
        selectTingkat.append('<option value=""> Pilih Tingkat </option>');
        $.each(tingkat, function(key, value) {
            selectTingkat.append('<option value="' + value.tingkat + '">' + value.tingkat + '</option>');
        });
    },
    error: function(xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});
