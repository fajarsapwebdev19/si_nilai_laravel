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
        url: 'kirim_nilai',
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
            });
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

$('#filter-ekskul').on('click', '.filter', function(e){
    e.preventDefault();
    let tapel = $('#filter-ekskul select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal!',
            text: 'Pilih Tahun Ajaran Terlebih Dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: 'show_siswa_ekskul/' + tapel,
                method: 'GET',
                success:function(response)
                {
                    $('#show-nilai-ekskul').html(response);
                }
            });
        });
    }
});

$('#show-nilai-ekskul').on('click', '.nilai', function(){
    let id = $(this).data('id');
    let tahun = $(this).data('tahun');
    let class_id = $(this).data('class');

    $('.nilai').removeClass('active');

    if(id == id)
    {
        $('.nilai').each(function() {
            if ($(this).data('id') == id) {
                $(this).addClass('active');
            }
        });
    }

    Swal.fire({
        title: 'Berhasil!',
        text: 'Ektrakulikuller Terpilih',
        icon: 'success'
    }).then(function(){
        $.ajax({
            url: 'input_n_ekskul',
            data: {
                ekskul_id : id,
                tahun : tahun,
                class_id : class_id
            },
            method: "GET",
            success:function(response)
            {
                $('#nilai-ekskul').html(response);
            }
        });
    });
});

$(document).on('change', 'select[name="nilai[]"]', function() {
    // Ambil nilai yang dipilih dari elemen select
    let selectedValue = $(this).val();

    // Ambil index dari elemen select yang diubah
    let index = $('select[name="nilai[]"]').index(this);

    // Ambil elemen textarea yang sesuai dengan select yang diubah
    let descriptionField = $('textarea[name="deskripsi[]"]').eq(index);

    // Tentukan deskripsi berdasarkan nilai yang dipilih
    switch (selectedValue) {
        case 'A':
            descriptionField.val('Siswa menunjukkan keunggulan dalam keterampilan dan sikap selama mengikuti kegiatan. Aktif berpartisipasi dan sering menjadi contoh bagi yang lain.');
            break;
        case 'B':
            descriptionField.val('Siswa aktif berpartisipasi dalam kegiatan dan menunjukkan keterampilan yang baik. Kadang-kadang membutuhkan bimbingan untuk penyempurnaan.');
            break;
        case 'C':
            descriptionField.val('Siswa berpartisipasi dengan baik namun menunjukkan keterbatasan dalam beberapa aspek. Masih membutuhkan peningkatan dalam keterampilan atau sikap.');
            break;
        case 'D':
            descriptionField.val('Siswa kurang aktif dalam berpartisipasi dan menunjukkan keterampilan atau sikap yang perlu banyak ditingkatkan. Membutuhkan perhatian lebih dalam bimbingan.');
            break;
        default:
            descriptionField.val('');
            break;
    }
});

$(document).on('submit', '#nilai-ekskul-input', function(e) {
    e.preventDefault();
    let data = $('#nilai-ekskul-input').serialize();

    $.ajax({
        url: "kirim_nilai_ekskul",
        data: data,
        method: "POST",
        success:function(response)
        {
            Swal.fire({
                title: 'Berhasil!',
                text: response.message,
                icon: 'success'
            });
        },
        error:function(xhr)
        {
            let error = xhr.responseJSON.message;

            Swal.fire({
                title: 'Gagal!',
                text: error,
                icon: 'error'
            });
        }
    });
});

$('#filter-kenaikan').on('click', '.filter', function(e){
    e.preventDefault();

    let tapel = $('#filter-kenaikan select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal!',
            text: 'Pilih Tahun Ajaran Terlebih dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: "show_siswa_kenaikan",
                data: {tapel: tapel},
                method: "GET",
                success:function(response)
                {
                    $('#show-kenaikan-siswa').html(response);
                }
            });
        });
    }
});

$(document).on('submit', '#show-kenaikan-siswa', function(e) {
    e.preventDefault();

    let data = $('#catatan-wakel').serialize();

    $.ajax({
        url: "kirim_catatan",
        data: data,
        method: "POST",
        success:function(response)
        {
            Swal.fire({
                title: 'Berhasil!',
                text: response.message,
                icon: 'success'
            });
        },
        error:function(xhr)
        {
            let error = xhr.responseJSON.message;

            Swal.fire({
                title: 'Gagal!',
                text: error,
                icon: 'error'
            });
        }
    });
});

$('#filter-cetak-raport').on('click', '.filter', function(e){
    e.preventDefault();

    let tapel = $('#filter-cetak-raport select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal!',
            text: 'Pilih Tahun Ajaran Terlebih dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: "show_siswa_raport",
                data: {tapel: tapel},
                method: "GET",
                success:function(response)
                {
                    $('#cetak').html(response);
                }
            });
        });
    }
});

$("#cetak").on('click', '.cover', function(){
    let id = $(this).data('user');

    window.open('cetak_cover/?siswa_id=' + id);
});

$("#cetak").on('click', '.identitas', function(){
    let id = $(this).data('user');

    window.open('cetak_identitas/?siswa_id=' + id);
});

$("#cetak").on('click', '.profil-sekolah', function(){
    window.open('cetak_profil_sekolah');
});

$("#cetak").on('click', '.raport', function(){
    let id = $(this).data('user');
    let tapel = $(this).data('tapel');

    window.open('cetak_raport_siswa/?siswa_id=' + id + '&tapel=' + tapel);
});

$("#filter-leger").on('click', '.filter', function(e){
    e.preventDefault();

    let tapel = $('#filter-leger select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal!',
            text: 'Pilih Tahun Ajaran Terlebih dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil !',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            window.open('cetak_leger/?tapel=' + tapel);
        });
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

