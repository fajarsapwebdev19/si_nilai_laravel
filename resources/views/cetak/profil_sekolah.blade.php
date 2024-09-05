<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td {
            padding: 8px;
            vertical-align: top;
        }
        .label {
            width: 20%;
            text-align: justify;
        }
        .colon {
            width: 1%;
            white-space: nowrap;
        }
        .value {
            width: 59%;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Judul Profil Sekolah -->
        <h3>PROFIL SEKOLAH</h3>
        <br><br><br>

        <!-- Informasi Umum -->
        <table>
            <tr>
                <td class="label">NPSN</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->npsn}}</td>
            </tr>
            <tr>
                <td class="label">Nama Sekolah</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->nama_sekolah}}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->alamat}}</td>
            </tr>
            <tr>
                <td class="label">Provinsi</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->provinsi}}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten / Kota</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->kab_kot}}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->kecamatan}}</td>
            </tr>
            <tr>
                <td class="label">Kelurahan</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->kelurahan}}</td>
            </tr>
            <tr>
                <td class="label">Kode POS</td>
                <td class="colon">:</td>
                <td class="value">{{$sekolah->kode_pos}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
