<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            box-sizing: border-box;
        }
        .container {
            width: 180mm; /* Lebar A4 */
            padding: 20px;
            background-color: #fff;
            position: relative;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td {
            padding: 8px;
            width: 1px;
            vertical-align: top;
        }
        .label {
            width: 25%;
            text-align: left;
        }
        .colon {
            width: 1%;
            text-align: center;
        }
        .value {
            width: 60%;
            text-align: left;
        }
        .photo-frame {
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #fff;
        }
        .photo-frame p {
            font-size: 12px;
            color: #888;
            margin: 0;
        }
        .nama_kepsek {
            text-decoration: underline;
            font-weight: 800;
        }
        .nip {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>KETERANGAN TENTANG DIRI PESERTA DIDIK</h3>
        <table>
            <tr>
                <td><strong>1</strong></td>
                <td class="label"><strong>Nama Lengkap</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->nama}}</td>
            </tr>
            <tr>
                <td><strong>2</strong></td>
                <td class="label"><strong>NISN</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->nisn}}</td>
            </tr>
            <tr>
                <td><strong>3</strong></td>
                <td class="label"><strong>Tempat, Tanggal Lahir</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->tempat_lahir}} , {{date('d-m-Y', strtotime($s->tanggal_lahir))}}</td>
            </tr>
            <tr>
                <td><strong>4</strong></td>
                <td class="label"><strong>Jenis Kelamin</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan"}}</td>
            </tr>
            <tr>
                <td><strong>5</strong></td>
                <td class="label"><strong>Agama</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->agama}}</td>
            </tr>
            <tr>
                <td><strong>6</strong></td>
                <td class="label"><strong>Anak Ke</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->anak_ke}}</td>
            </tr>
            <tr>
                <td><strong>7</strong></td>
                <td class="label"><strong>Alamat</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->alamat}}, RT {{$s->rt}} / RW {{$s->rw}}, Kel {{$s->kelurahan}}, Kec {{$s->kecamatan}}, Kode Pos {{$s->kode_pos}}</td>
            </tr>
            <tr>
                <td><strong>8</strong></td>
                <td class="label"><strong>Nama Orang Tua</strong></td>
                <td class="colon"></td>
                <td class="value"></td>
            </tr>
            <tr>
                <td></td>
                <td class="label"><strong>a. Ayah</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->nama_ayah}}</td>
            </tr>
            <tr>
                <td></td>
                <td class="label"><strong>b. Ibu</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->nama_ibu}}</td>
            </tr>
            <tr>
                <td><strong>9</strong></td>
                <td class="label"><strong>Pekerjaan Orang Tua</strong></td>
                <td class="colon"></td>
                <td class="value"></td>
            </tr>
            <tr>
                <td></td>
                <td class="label"><strong>a. Ayah</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->pekerjaan_ayah}}</td>
            </tr>
            <tr>
                <td></td>
                <td class="label"><strong>b. Ibu</strong></td>
                <td class="colon">:</td>
                <td class="value">{{$s->pekerjaan_ibu}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td colspan="12"></td>
                <td>
                    <div class="photo-frame">
                        <p>Foto 3x4</p>
                    </div>
                </td>
                <td class="value">
                    <p>Tangerang, {{date('d-m-Y')}}</p>
                    <p>Kepala Sekolah</p>
                    <br><br><br>
                    <p class="nama_kepsek">{{$ks->nama ?? "_________________"}}</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
