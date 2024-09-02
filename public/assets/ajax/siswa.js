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
