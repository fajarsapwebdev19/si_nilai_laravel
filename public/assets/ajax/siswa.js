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

function updateClock() {
    const optionsDate = { timeZone: 'Asia/Jakarta', weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const optionsTime = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

    const now = new Date();
    const dateString = now.toLocaleDateString('id-ID', optionsDate);
    const timeString = now.toLocaleTimeString('id-ID', optionsTime);

    document.getElementById('clock').innerHTML = `${dateString}, ${timeString}`;
}

// Update the clock immediately and then every second
updateClock();
setInterval(updateClock, 1000);

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

$('#filter-show-nilai').on('click', '.filter', function(e){
    e.preventDefault();
    let tapel = $('#filter-show-nilai select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal !',
            text: 'Pilih Tahun Ajaran Terlebih dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil !',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            $.ajax({
                url: "show_nilai",
                data: {tapel: tapel},
                method: "GET",
                success:function(response)
                {
                    $('#show-nilai').html(response);
                }
            });
        });
    }
});

$('#filter-cetak').on('click', '.filter', function(e){
    e.preventDefault();
    let tapel = $('#filter-cetak select[name=tahun_ajaran]').val();

    if(tapel == "")
    {
        Swal.fire({
            title: 'Gagal !',
            text: 'Pilih Tahun Ajaran Terlebih dahulu',
            icon: 'error'
        });
    }else{
        Swal.fire({
            title: 'Berhasil !',
            text: 'Tahun Ajaran Valid',
            icon: 'success'
        }).then(function(){
            window.open('cetak_raport_siswa/?tapel=' + tapel);
        });
    }
});


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
