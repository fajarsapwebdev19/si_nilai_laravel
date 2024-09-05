<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover - {{$s->nama}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .cover {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: white;
            box-sizing: border-box;
        }

        .content h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .content h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .content h4 {
            font-size: 18px;
            margin-top: 40px;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .content img {
            margin: 20px 0;
        }
        span{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="cover">
        <div class="content">
            <br><br><br>

            @if($sch->logo)
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($sch->logo))) }}" alt="Image" width="250">
            @else
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo/default.png'))) }}" alt="Image" width="250">
            @endif

            <h1>LAPORAN</h1>
            <h2>HASIL BELAJAR SISWA</h2>
            <br><br>

            <h4>Nama Siswa:</h4>
            <p>{{$s->nama}}</p>

            <h4>NISN:</h4>
            <p>{{$s->nisn}}</p>

            <br><br><br>
            <h2>{{$sch->nama_sekolah}}</h2>
            <span>NPSN : {{ $sch->npsn; }} | Alamat : {{$sch->alamat}}</span>
        </div>
    </div>
</body>
</html>
