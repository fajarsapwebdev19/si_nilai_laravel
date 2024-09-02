function updateClock() {
    const optionsDate = { timeZone: 'Asia/Jakarta', weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const optionsTime = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

    const now = new Date();
    const dateString = now.toLocaleDateString('id-ID', optionsDate);
    const timeString = now.toLocaleTimeString('id-ID', optionsTime);

    document.getElementById('clock').innerHTML = `${dateString}, ${timeString}`;
}

$.ajax({
    url: 'hitung_siswa',
    method: 'GET',
    success: function (response) {
        let namaRombel = [];
        let lakiLaki = [];
        let perempuan = [];

        response.forEach(function (data) {
            namaRombel.push(data.nama_rombel);
            lakiLaki.push(data.L);
            perempuan.push(data.P);
        });

        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [{
                name: 'Laki-Laki',
                data: lakiLaki
            }, {
                name: 'Perempuan',
                data: perempuan
            }],
            xaxis: {
                categories: namaRombel
            },
            yaxis: {
                title: {
                    text: 'Jumlah Siswa'
                }
            },
            title: {
                text: 'Jumlah Siswa Per Kelas Berdasarkan Jenis Kelamin',
                align: 'center'
            }
        }

        var chart = new ApexCharts(document.querySelector("#siswa-count-chart"), options);

        chart.render();
    }
});

function pesan() {
    $.ajax({
        url: "pesan_dashboard",
        method: "GET",
        success: function (response) {
            $('#pesan').html(response);
        }
    });
}

pesan();

// Update the clock immediately and then every second
updateClock();
setInterval(updateClock, 1000);

$('#filter-nilai').on('click', '.filter', function (e) {
    e.preventDefault();
    let tapel = $('select[name=tahun_ajaran]').val();

    if (tapel == "") {
        Swal.fire({
            title: 'Gagal!',
            text: 'Silahkan Pilih Tahun Ajaran !',
            icon: 'error'
        });
    } else {

        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: 'show_mapel/' + tapel,
                method: 'GET',
                success: function (response) {
                    $('#show_mapel').html(response);
                    $('.nilai').attr('data-tapel', tapel);
                }
            });
        });
    }
});

$('#show_mapel').on('click', '.nilai', function(){
    let id = $(this).data('id');
    let name_mapel = $(this).data('mapel');

    $.ajax({
        url: 'show_student/'+id,
        method: 'GET',
        success:function(response)
        {
            $('#input_nilai').modal('show');
            $('#penilaian').html(response);
            $('#mapel_name').text(name_mapel);
        }
    });
});

$('#show_mapel,#penilaian').on('click', '.simpan', function(e){
    e.preventDefault();

    let data = $('#penilaian').serialize();

    $.ajax({
        url: 'kirim_nilai/',
        data: data,
        method: "POST",
        success:function(response)
        {
            Swal.fire({
                title: 'Berhasil!',
                text: response.message,
                icon: 'success'
            }).then(function(){
                $('#input_nilai').modal('hide');
            });
        },
        error:function(xhr)
        {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                title: 'Gagal!',
                text: errorMessage,
                icon: 'error'
            });
        }
    });
});

$('#filter-nilai-sikap').on('click', '.filter', function (e) {
    e.preventDefault();
    let tapel = $('select[name=tahun_ajaran]').val();

    if (tapel == "") {
        Swal.fire({
            title: 'Gagal!',
            text: 'Silahkan Pilih Tahun Ajaran',
            icon: 'error'
        });
    } else {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: 'show_siswa_sikap/' + tapel,
                method: 'GET',
                success: function (response) {
                    $('#show_siswa_sikap').html(response);
                }
            });
        });
    }
});

$('#show_siswa_sikap,#nilai-sikap').on('click', '.simpan', function(e){
    e.preventDefault();
    let data = $('#nilai-sikap').serialize();

    $.ajax({
        url: 'kirim_nilai_sikap',
        method: 'POST',
        data: data,
        success:function(response)
        {
            Swal.fire({
                title: 'Berhasil!',
                text: response.message,
                icon: 'success'
            })
        },
        error:function(xhr)
        {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                title: 'Gagal!',
                text: errorMessage,
                icon: 'error'
            });
        }
    });
});

$('#filter-rekap-absensi').on('click', '.filter', function (e) {
    e.preventDefault();
    let tapel = $('select[name=tahun_ajaran]').val();

    if (tapel == "") {
        Swal.fire({
            title: 'Gagal!',
            text: 'Silahkan Pilih Tahun Ajaran Terlebih Dahulu',
            icon: 'error'
        });
    } else {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: 'show_siswa_absensi/'+tapel,
                method: 'GET',
                success: function (response) {
                    $('#show_siswa_absensi').html(response);
                }
            });
        });
    }
});

$('#show_siswa_absensi,#rekap-absensi-siswa').on('click', '.simpan', function(e){
    e.preventDefault();

    let data = $('#rekap-absensi-siswa').serialize();

    $.ajax({
        url: 'kirim_absensi',
        method: 'POST',
        data: data,
        success: function (response) {
            Swal.fire({
                title: 'Berhasil!',
                text: response.message,
                icon: 'success'
            })
        },
        error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                title: 'Gagal!',
                text: errorMessage,
                icon: 'error'
            });
        }
    });
});

function pesan() {
    $.ajax({
        url: "pesan_dashboard",
        method: "GET",
        success: function (response) {
            $('#pesan').html(response);
        }
    });
}

pesan();


$('.logout').click(function () {
    $.ajax({
        url: "logout/",
        method: "GET",
        success: function (response) {
            if (response.status == "ok") {
                window.location.href = '/';
                localStorage.setItem('logoutMessage', 'Logout berhasil');
            }
        }
    });
});

