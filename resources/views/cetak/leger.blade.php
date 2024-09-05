<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leger Nilai Siswa {{$nama_kelas}}</title>
    <style>
        *{
            font-family: 'Arial';
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .no-border {
            border: none;
        }
        .no-border th, .no-border td {
            border: none;
            padding: 8px;
            text-align: left;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        thead th {
            background-color: #f2f2f2;
        }
        th[colspan] {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <!-- Tabel awal tanpa border -->
    <table class="no-border">
        <thead>
            <tr>
                <td colspan="10"><strong>LEGER NILAI SISWA {{$nama_kelas}}</strong></td>
            </tr>
            <tr>
                <td colspan="9"><strong>{{$nama_sekolah}}</strong></td>
            </tr>
            <tr>
                <td colspan="9"><strong>TAHUN PELAJARAN {{$tapel}} SEMESTER {{$semester}}</strong></td>
            </tr>
            <tr>
                <td colspan="9">Waktu download: {{ date('d-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <td colspan="9">Di Unduh oleh : {{ session('userData')->nama }}</td>
            </tr>
        </thead>
    </table>

    <!-- Tabel dengan border -->
    <table>
        <thead>
            <tr>
                <th rowspan="2">Peringkat</th>
                <th rowspan="2">Nama Siswa</th>

                {{-- Kelompok A --}}
                @foreach($kel_a as $ka)
                    <th colspan="2">{{ $ka->kode }}</th>
                @endforeach

                {{-- Kelompok B --}}
                @foreach($kel_b as $kb)
                    <th colspan="2">{{ $kb->kode }}</th>
                @endforeach

                {{-- Kelompok C1 --}}
                @foreach($kel_c1 as $kc1)
                    <th colspan="2">{{ $kc1->kode }}</th>
                @endforeach

                {{-- Kelompok C2 --}}
                @foreach($kel_c2 as $kc2)
                    <th colspan="2">{{ $kc2->kode }}</th>
                @endforeach

                {{-- Kelompok C3 --}}
                @foreach($kel_c3 as $kc3)
                    <th colspan="2">{{ $kc3->kode }}</th>
                @endforeach

                <th rowspan="2">Total</th>
                <th rowspan="2">Rata-rata</th>
            </tr>
            <tr>
                {{-- Kelompok A --}}
                @foreach($kel_a as $ka)
                    <th>P</th>
                    <th>K</th>
                @endforeach

                {{-- Kelompok B --}}
                @foreach($kel_b as $kb)
                    <th>P</th>
                    <th>K</th>
                @endforeach

                {{-- Kelompok C1 --}}
                @foreach($kel_c1 as $kc1)
                    <th>P</th>
                    <th>K</th>
                @endforeach

                {{-- Kelompok C2 --}}
                @foreach($kel_c2 as $kc2)
                    <th>P</th>
                    <th>K</th>
                @endforeach

                {{-- Kelompok C3 --}}
                @foreach($kel_c3 as $kc3)
                    <th>P</th>
                    <th>K</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                // Mengelompokkan nilai berdasarkan user_id dan menghitung total dan rata-rata
                $rankedNilai = $nilai->groupBy('user_id')->map(function($items) {
                    $totalPengetahuan = 0;
                    $totalKeterampilan = 0;
                    foreach ($items as $item) {
                        $totalPengetahuan += $item->nilai_pengetahuan;
                        $totalKeterampilan += $item->nilai_keterampilan;
                    }
                    return [
                        'total' => $totalPengetahuan + $totalKeterampilan,
                        'total_pengetahuan' => $totalPengetahuan,
                        'total_keterampilan' => $totalKeterampilan,
                        'nama' => $items->first()->nama,
                        'items' => $items,
                    ];
                })->sortByDesc('total')->values();
            @endphp

            @php $rank = 1; @endphp
            @foreach($rankedNilai as $data)
                <tr>
                    <td>{{ $rank++ }}</td>
                    <td>{{ $data['nama'] }}</td>

                    {{-- Kelompok A --}}
                    @foreach($kel_a as $ka)
                        @php
                            $mapel = $data['items']->firstWhere('kode', $ka->kode);
                            $mapelPengetahuan = $mapel ? $mapel->nilai_pengetahuan : 0;
                            $mapelKeterampilan = $mapel ? $mapel->nilai_keterampilan : 0;
                        @endphp
                        <td>{{ $mapelPengetahuan }}</td>
                        <td>{{ $mapelKeterampilan }}</td>
                    @endforeach

                    {{-- Kelompok B --}}
                    @foreach($kel_b as $kb)
                        @php
                            $mapel = $data['items']->firstWhere('kode', $kb->kode);
                            $mapelPengetahuan = $mapel ? $mapel->nilai_pengetahuan : 0;
                            $mapelKeterampilan = $mapel ? $mapel->nilai_keterampilan : 0;
                        @endphp
                        <td>{{ $mapelPengetahuan }}</td>
                        <td>{{ $mapelKeterampilan }}</td>
                    @endforeach

                    {{-- Kelompok C1 --}}
                    @foreach($kel_c1 as $kc1)
                        @php
                            $mapel = $data['items']->firstWhere('kode', $kc1->kode);
                            $mapelPengetahuan = $mapel ? $mapel->nilai_pengetahuan : 0;
                            $mapelKeterampilan = $mapel ? $mapel->nilai_keterampilan : 0;
                        @endphp
                        <td>{{ $mapelPengetahuan }}</td>
                        <td>{{ $mapelKeterampilan }}</td>
                    @endforeach

                    {{-- Kelompok C2 --}}
                    @foreach($kel_c2 as $kc2)
                        @php
                            $mapel = $data['items']->firstWhere('kode', $kc2->kode);
                            $mapelPengetahuan = $mapel ? $mapel->nilai_pengetahuan : 0;
                            $mapelKeterampilan = $mapel ? $mapel->nilai_keterampilan : 0;
                        @endphp
                        <td>{{ $mapelPengetahuan }}</td>
                        <td>{{ $mapelKeterampilan }}</td>
                    @endforeach

                    {{-- Kelompok C3 --}}
                    @foreach($kel_c3 as $kc3)
                        @php
                            $mapel = $data['items']->firstWhere('kode', $kc3->kode);
                            $mapelPengetahuan = $mapel ? $mapel->nilai_pengetahuan : 0;
                            $mapelKeterampilan = $mapel ? $mapel->nilai_keterampilan : 0;
                        @endphp
                        <td>{{ $mapelPengetahuan }}</td>
                        <td>{{ $mapelKeterampilan }}</td>
                    @endforeach

                    @php
                        $total = $data['total'];
                        $totalMataPelajaran = count($kel_a) * 2 + count($kel_b) * 2 + count($kel_c1) * 2 + count($kel_c2) * 2 + count($kel_c3) * 2;
                        $average = $total / $totalMataPelajaran;
                    @endphp
                    <td>{{ $total }}</td>
                    <td>{{ round($average, 2) }}</td> {{-- Membulatkan rata-rata dengan 2 desimal --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
