let apiUrl1 = "https://masterdata.ppdb.dev19.my.id/api/work.php";
let apiUrl2 = "https://masterdata.ppdb.dev19.my.id/api/education.php";
let apiUrl3 = "https://masterdata.ppdb.dev19.my.id/api/religion.php";

// selected update data
// pendidikan ibu
function select_pendidikan_ibu(pendidikan_ibu) {
    $.ajax({
        url: apiUrl2,
        method: "GET",
        success: function (response) {
            let pendidikan = response.data;

            let p_ibu = $('#p_ibu');
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            p_ibu.empty();
            p_ibu.append('<option value=""> Pilih Pendidikan </option>');
            $.each(pendidikan, function (key, value) {
                if (value.education == pendidikan_ibu) {
                    p_ibu.append('<option value="' + value.education + '" selected>' + value.education + '</option>');
                } else {
                    p_ibu.append('<option value="' + value.education + '">' + value.education + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pendidikan ayah
function select_pendidikan_ayah(pendidikan_ayah) {
    $.ajax({
        url: apiUrl2,
        method: "GET",
        success: function (response) {
            let pendidikan = response.data;
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            let p_ayah = $('#p_ayah');
            // Mengosongkan elemen select sebelum menambahkan opsi baru
            p_ayah.empty();
            p_ayah.append('<option value=""> Pilih Pendidikan </option>');
            $.each(pendidikan, function (key, value) {
                if (value.education == pendidikan_ayah) {
                    p_ayah.append('<option value="' + value.education + '" selected>' + value.education + '</option>');
                } else {
                    p_ayah.append('<option value="' + value.education + '">' + value.education + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pekerjaan ibu
function select_pekerjaan_ibu(pekerjaan_ibu) {
    $.ajax({
        url: apiUrl1,
        method: "GET",
        success: function (response) {
            console.log("API Response:", response); // Log response to inspect structure
            let pekerjaan = response.data;
            let pkj_ibu = $("#pkj_ibu");
            pkj_ibu.append('<option value=""> Pilih Pekerjaan </option>');
            $.each(pekerjaan, function (key, value) {
                if (value.work == pekerjaan_ibu) {
                    pkj_ibu.append('<option value="' + value.work + '" selected>' + value.work + '</option>');
                } else {
                    pkj_ibu.append('<option value="' + value.work + '">' + value.work + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}
// pekerjaan ayah
function select_pekerjaan_ayah(pekerjaan_ayah) {
    $.ajax({
        url: apiUrl1,
        method: "GET",
        success: function (response) {
            console.log("API Response:", response); // Log response to inspect structure
            let pekerjaan = response.data;
            let pkj_ayah = $("#pkj_ayah");
            pkj_ayah.append('<option value=""> Pilih Pekerjaan </option>');
            $.each(pekerjaan, function (key, value) {
                if (value.work == pekerjaan_ayah) {
                    pkj_ayah.append('<option value="' + value.work + '" selected>' + value.work + '</option>');
                } else {
                    pkj_ayah.append('<option value="' + value.work + '">' + value.work + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}

// agama
function select_agama(agamaselect) {
    $.ajax({
        url: apiUrl3,
        method: "GET",
        success: function (response) {
            let agama = response.data;
            let selectAgama = $('#agm');

            // Mengosongkan elemen select sebelum menambahkan opsi baru
            selectAgama.empty();

            // Menambahkan opsi default
            selectAgama.append('<option value=""> Pilih Agama </option>');

            // Menambahkan opsi dari respons API
            $.each(agama, function (key, value) {
                if (value.religion_name == agamaselect) {
                    selectAgama.append('<option value="' + value.religion_name + '" selected>' + value.religion_name + '</option>');
                } else {
                    selectAgama.append('<option value="' + value.religion_name + '">' + value.religion_name + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}

function select_tingkat(tingkat_select)
{
    $.ajax({
        url: 'get_tingkat',
        method: "GET",
        success: function (response) {
            let tingkat = response;
            let selectTingkat = $("#tkt");
            selectTingkat.empty();
            selectTingkat.append('<option value=""> Pilih Tingkat </option>');
            $.each(tingkat, function (key, value) {
                if (value.tingkat == tingkat_select) {
                    selectTingkat.append('<option value="' + value.tingkat + '" selected>' + value.tingkat + '</option>');
                } else {
                    selectTingkat.append('<option value="' + value.tingkat + '">' + value.tingkat + '</option>');
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });
}

// select
// pekerjaan ayah & ibu
$.ajax({
    url: apiUrl1,
    method: "GET",
    success: function (response) {
        let pekerjaan = response.data;
        let pkj_ayah = $(".pkj_ayah");
        let pkj_ibu = $(".pkj_ibu");
        pkj_ibu.append('<option value=""> Pilih Pekerjaan </option>');
        pkj_ayah.append('<option value=""> Pilih Pekerjaan </option>');
        $.each(pekerjaan, function (key, value) {
            pkj_ibu.append('<option value="' + value.work + '">' + value.work + '</option>');
            pkj_ayah.append('<option value="' + value.work + '">' + value.work + '</option>');
        });
    },
    error: function (xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// pendidikan ayah & ibu
$.ajax({
    url: apiUrl2,
    method: "GET",
    success: function (response) {
        let pendidikan = response.data;
        let p_ibu = $('.p_ibu');
        let p_ayah = $('.p_ayah');
        p_ayah.append('<option value=""> Pilih Pendidikan </option>');
        p_ibu.append('<option value=""> Pilih Pendidikan </option>');
        $.each(pendidikan, function (key, value) {
            p_ayah.append('<option value="' + value.education + '">' + value.education + '</option>');
            p_ibu.append('<option value="' + value.education + '">' + value.education + '</option>');
        });
    },
    error: function (xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});

// agama
$.ajax({
    url: apiUrl3,
    method: "GET",
    success: function (response) {
        let agama = response.data;
        let selectAgama = $('.agm');

        // Mengosongkan elemen select sebelum menambahkan opsi baru
        selectAgama.empty();

        // Menambahkan opsi default
        selectAgama.append('<option value=""> Pilih Agama </option>');

        // Menambahkan opsi dari respons API
        $.each(agama, function (key, value) {
            selectAgama.append('<option value="' + value.religion_name + '">' + value.religion_name + '</option>');
        });
    },
    error: function (xhr, status, error) {
        console.error("An error occurred with API 1: " + error);
    }
});



const currentUrl = window.location.pathname;

if (currentUrl.includes('/admin/data/siswa')) {
    console.log("URL matched. Executing AJAX call..."); // Debugging log

    // AJAX call to get_tingkat
    $.ajax({
        url: '/admin/data/get_tingkat',
        method: "GET",
        success: function (response) {
            console.log("AJAX call successful. Response:", response); // Debugging log
            let tingkat = response;
            let selectTingkat = $(".tkt");
            selectTingkat.empty();
            selectTingkat.append('<option value=""> Pilih Tingkat </option>');
            $.each(tingkat, function (key, value) {
                selectTingkat.append('<option value="' + value.tingkat + '">' + value.tingkat + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred with API 1: " + error);
        }
    });

    function select_jurusan(jurusan_select)
    {
        $.ajax({
            url: 'get_jurusan',
            method: "GET",
            success: function (response) {
                let jurusan = response;
                let selectTingkat = $("#jurusan");
                selectTingkat.empty();
                selectTingkat.append('<option value=""> Pilih Tingkat </option>');
                $.each(jurusan, function (key, value) {
                    if (value.id == jurusan_select) {
                        selectTingkat.append('<option value="' + value.id + '" selected>' + value.nama_kejuruan + '</option>');
                    } else {
                        selectTingkat.append('<option value="' + value.id + '">' + value.nama_kejuruan + '</option>');
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error("An error occurred with API 1: " + error);
            }
        });
    }
}

