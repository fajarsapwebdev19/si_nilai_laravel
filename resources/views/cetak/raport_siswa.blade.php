<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor - {{$siswa->nama}} ({{$siswa->nisn}})</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            font-size: 12px;
            font-weight: 400;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
        }

        .text-left {
            text-align: left;
        }

        h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 4px;
            text-align: center;
        }
        .section-title {
            text-align: left;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .details {
            margin-bottom: 10px;
        }
        .details table td {
            text-align: left;
            border: none;
            padding: 2px;
        }
        .nilai thead{
            background-color: #eaeaea;
        }

        .no-border {
            border: none !important;
        }

        #tanda-tangan{
            width: 100% !important;
        }

        #tanda-tangan, thead{
            border: none;
        }

        #tanda-tangan td {
            width: 50%;
            vertical-align: top;
            border: none;
        }

        .label {
            width: 25%;
            text-align: left;
        }
        .colon {
            width: 2%;
            text-align: center;
        }
        .value {
            width: 40%;
            text-align: left;
        }
        .garis{
            border: 1px solid #000;
        }

        .page-break {
            page-break-after: always;
        }

        .naik{
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="details">
            <table class="no-border">
                <tr>
                    <td class="label"><strong>Nama Peserta Didik</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $siswa->nama }}</td>
                    <td class="label"><strong>Tahun Ajaran</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $tahun_ajaran }}</td>
                </tr>
                <tr>
                    <td class="label"><strong>NISN</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $siswa->nisn }}</td>
                    <td class="label"><strong>Semester</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{$smt->semester}} ({{$semester}})</td>
                </tr>
                <tr>
                    <td class="label"><strong>Nama Sekolah</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $sekolah->nama_sekolah }}</td>
                    <td class="label"><strong>Kelas</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $nama_kelas }}</td>
                </tr>
                <tr>
                    <td class="label"><strong>NPSN</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $sekolah->npsn }}</td>
                    <td class="label"><strong>Program Keahlian</strong></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $siswa->nama_kejuruan }}</td>
                </tr>
            </table>

            <div class="garis"></div>

            <h3>Laporan Hasil Belajar</h3>
        </div>

        {{-- / Header --}}

        {{-- Nilai Akademik --}}
        <p class="section-title"><b>A. Nilai Akademik</b></p>
        <table class="nilai">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Mata Pelajaran</th>
                    <th rowspan="2">KKM</th>
                    <th colspan="2">Penilaian</th>
                    <th rowspan="2">Nilai Akhir</th>
                    <th rowspan="2">Predikat</th>
                </tr>
                <tr>
                    <th>Pengetahuan</th>
                    <th>Keterampilan</th>
                </tr>
            </thead>
            <tbody>
                {{-- Kelompok A --}}
                @if($kel_a)
                    <tr>
                        <th colspan="7" class="text-left">A. Muatan Nasional</th>
                    </tr>
                @endif
                @foreach ($kel_a as $index => $ka)
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $ka->id)->first();
                        $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                        $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                        $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                        $predikat = $nilaiAkhir >= $ka->kkm + 20 ? 'A+' :
                                    ($nilaiAkhir >= $ka->kkm + 10 ? 'A' :
                                    ($nilaiAkhir >= $ka->kkm ? 'B' :
                                    ($nilaiAkhir >= $ka->kkm - 10 ? 'C' : 'D')));
                    @endphp
                    <tr>
                        <th>{{ $ka->urutan }}</th>
                        <td class="text-left">{{ $ka->nama_mapel }}</td>
                        <td>{{ $ka->kkm }}</td>
                        <td>{{ $pengetahuan }}</td>
                        <td>{{ $keterampilan }}</td>
                        <td>{{ number_format($nilaiAkhir, 2) }}</td>
                        <td>{{ $predikat }}</td>
                    </tr>
                @endforeach
                {{-- end Kelompok A --}}

                {{-- Kelompok B --}}
                @if($kel_b)
                    <tr>
                        <th colspan="7" class="text-left">B. Muatan Kewilayahan</th>
                    </tr>
                @endif
                @foreach ($kel_b as $index => $kb)
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $kb->id)->first();
                        $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                        $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                        $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                        $predikat = $nilaiAkhir >= $kb->kkm + 20 ? 'A+' :
                                    ($nilaiAkhir >= $kb->kkm + 10 ? 'A' :
                                    ($nilaiAkhir >= $kb->kkm ? 'B' :
                                    ($nilaiAkhir >= $kb->kkm - 10 ? 'C' : 'D')));
                    @endphp
                    <tr>
                        <th>{{ $kb->urutan }}</th>
                        <td class="text-left">{{ $kb->nama_mapel }}</td>
                        <td>{{ $kb->kkm }}</td>
                        <td>{{ $pengetahuan }}</td>
                        <td>{{ $keterampilan }}</td>
                        <td>{{ number_format($nilaiAkhir, 2) }}</td>
                        <td>{{ $predikat }}</td>
                    </tr>
                @endforeach
                {{-- end Kelompok B --}}

                {{-- Kelompok C1 --}}
                @if($kel_c1)
                    <tr>
                        <th colspan="7" class="text-left">C1. Dasar Bidang Keahlian</th>
                    </tr>
                @endif
                @foreach ($kel_c1 as $index => $kc1)
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $kc1->id)->first();
                        $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                        $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                        $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                        $predikat = $nilaiAkhir >= $kc1->kkm + 20 ? 'A+' :
                                    ($nilaiAkhir >= $kc1->kkm + 10 ? 'A' :
                                    ($nilaiAkhir >= $kc1->kkm ? 'B' :
                                    ($nilaiAkhir >= $kc1->kkm - 10 ? 'C' : 'D')));
                    @endphp
                    <tr>
                        <th>{{ $kc1->urutan }}</th>
                        <td class="text-left">{{ $kc1->nama_mapel }}</td>
                        <td>{{ $kc1->kkm }}</td>
                        <td>{{ $pengetahuan }}</td>
                        <td>{{ $keterampilan }}</td>
                        <td>{{ number_format($nilaiAkhir, 2) }}</td>
                        <td>{{ $predikat }}</td>
                    </tr>
                @endforeach
                {{-- end Kelompok C1 --}}

                {{-- Kelompok C2 --}}
                @if($kel_c2)
                    <tr>
                        <th colspan="7" class="text-left">C2. Dasar Program Keahlian</th>
                    </tr>
                @endif
                @foreach ($kel_c2 as $index => $kc2)
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $kc2->id)->first();
                        $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                        $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                        $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                        $predikat = $nilaiAkhir >= $kc2->kkm + 20 ? 'A+' :
                                    ($nilaiAkhir >= $kc2->kkm + 10 ? 'A' :
                                    ($nilaiAkhir >= $kc2->kkm ? 'B' :
                                    ($nilaiAkhir >= $kc2->kkm - 10 ? 'C' : 'D')));
                    @endphp
                    <tr>
                        <th>{{ $kc2->urutan }}</th>
                        <td class="text-left">{{ $kc2->nama_mapel }}</td>
                        <td>{{ $kc2->kkm }}</td>
                        <td>{{ $pengetahuan }}</td>
                        <td>{{ $keterampilan }}</td>
                        <td>{{ number_format($nilaiAkhir, 2) }}</td>
                        <td>{{ $predikat }}</td>
                    </tr>
                @endforeach
                {{-- end Kelompok C2 --}}

                {{-- Kelompok C3 --}}
                @if($kel_c3)
                    <tr>
                        <th colspan="7" class="text-left">C3. Kompetensi Keahlian</th>
                    </tr>
                @endif
                @foreach ($kel_c3 as $index => $kc3)
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $kc3->id)->first();
                        $pengetahuan = $nilaiMapel ? $nilaiMapel->nilai_pengetahuan : 0;
                        $keterampilan = $nilaiMapel ? $nilaiMapel->nilai_keterampilan : 0;
                        $nilaiAkhir = ($pengetahuan + $keterampilan) / 2;
                        $predikat = $nilaiAkhir >= $kc3->kkm + 20 ? 'A+' :
                                    ($nilaiAkhir >= $kc3->kkm + 10 ? 'A' :
                                    ($nilaiAkhir >= $kc3->kkm ? 'B' :
                                    ($nilaiAkhir >= $kc3->kkm - 10 ? 'C' : 'D')));
                    @endphp
                    <tr>
                        <th>{{ $kc3->urutan }}</th>
                        <td class="text-left">{{ $kc3->nama_mapel }}</td>
                        <td>{{ $kc3->kkm }}</td>
                        <td>{{ $pengetahuan }}</td>
                        <td>{{ $keterampilan }}</td>
                        <td>{{ number_format($nilaiAkhir, 2) }}</td>
                        <td>{{ $predikat }}</td>
                    </tr>
                @endforeach
                {{-- end Kelompok C3 --}}
            </tbody>
        </table>

        {{-- / Nilai Akademik --}}

        {{-- Nilai Sikap --}}
        <p class="section-title">B. Nilai Sikap</p>
        <table>
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th width="150">Aspek Sikap</th>
                    <th width="90">Predikat</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sikap Spiritual</td>
                    <td>{{$ns->spiritual ?? "-"}}</td>
                    <td>
                        @if($ns)
                            @if ($ns->spiritual == "A")
                                Sangat aktif dalam ibadah dan kegiatan spiritual lainnya
                            @elseif ($ns->spiritual == "B")
                                Aktif dalam ibadah, kadang kurang konsisten
                            @elseif ($ns->spiritual == "C")
                                Terkadang aktif dalam ibadah, perlu motivasi lebih
                            @elseif ($ns->spiritual == "D")
                                Jarang mengikuti ibadah, perlu peningkatan motivasi
                            @elseif ($ns->spiritual == "")
                                -
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sikap Sosial</td>
                    <td>{{$ns->sosial ?? "-"}}</td>
                    <td>
                        @if($ns)
                            @if ($ns->sosial == "A")
                                Selalu menunjukkan sikap sopan santun
                            @elseif ($ns->sosial == "B")
                                Biasanya sopan, kadang kurang perhatian
                            @elseif ($ns->sosial == "C")
                                Kadang tidak sopan dalam interaksi
                            @elseif ($ns->sosial == "D")
                                Sering menunjukkan sikap tidak sopan
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- / Nilai Sikap --}}

        <div class="page-break"></div>

        {{-- Catatan Akademis --}}
        <p class="section-title">C. Catatan Akademis</p>
        <table>
            <tr>
                <td class="text-left">
                    {{$kn->deskripsi ?? ""}}
                </td>
            </tr>
        </table>

        {{-- / Catatan Akademis --}}

        {{-- Ekskul --}}
        <p class="section-title">D. Ekstrakulikuller</p>
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th width="190">Kegiatan Eksktrakulikuller</th>
                    <th width="50">Predikat</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($e as $index => $eks)
                    @if($ne)

                        @php
                            $nilai_ekskul = $ne->where('ekskul_id', $eks->id)->first();
                            $nilai = $nilai_ekskul ? $nilai_ekskul->nilai : '-';
                            $deskripsi = $nilai_ekskul ? $nilai_ekskul->deskripsi : '-';
                        @endphp
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$eks->nama_ekstrakulikuler}}</td>
                            <td>{{$nilai}}</td>
                            <td>{{$deskripsi}}</td>
                        </tr>
                    @else
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$eks->nama_ekstrakulikuler}}</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    @endif

                @endforeach
            </tbody>
        </table>
        {{-- / Ekskul --}}

        {{-- Ketidakhadiran --}}
        <p class="section-title">E. Ketidakhadiran</p>
        <table style="width: 50%">
            <thead>
                <tr>
                    <td width="150">
                        Sakit
                    </td>
                    <td width="10">
                        :
                    </td>
                    <td class="200">
                        <strong>{{$kt->sakit ?? "-"}} Hari</strong>
                    </td>
                </tr>
                <tr>
                    <td width="150">
                        Izin
                    </td>
                    <td width="10">
                        :
                    </td>
                    <td class="200">
                        <strong>{{$kt->izin ?? "-"}} Hari</strong>
                    </td>
                </tr>
                <tr>
                    <td width="150">
                        Tanpa Keterangan
                    </td>
                    <td width="10">
                        :
                    </td>
                    <td class="200">
                        <strong>{{$kt->tanpa_keterangan ?? "-"}} Hari</strong>
                    </td>
                </tr>
            </thead>
        </table>
        {{-- / Ketidakhadiran --}}

        {{-- Status Kenaikan --}}
        @if($semester == 2)
            <p class="section-title">F. Kenaikan Kelas</p>
            <table>
                <thead>
                    <tr>
                        <td>
                            <span class="{{$kn->status_kenaikan == "Tidak" ? "naik" : ""}}">NAIK</span> / <span class="{{$kn->status_kenaikan == "Ya" ? "naik" : ""}}">TIDAK NAIK</span>
                        </td>
                    </tr>
                </thead>
            </table>
        @endif
        {{-- / Status Kenaikan --}}

        {{-- Tanda Tangan --}}
        <div class="section-title"></div>
        <br><br>
        <table id="tanda-tangan">
            <thead>
                <tr>
                    <td>
                        <span>Mengetahui,</span>
                        <br>
                        <span>Orang Tua/Wali</span>
                        <br><br><br><br><br><br><br>
                        <strong>{{$siswa->nama_ayah ?? "______________________________" }}</strong>
                    </td>
                    <td>
                        <span>{{$sekolah->kab_kot}}, {{date('d-m-Y')}}</span>
                        <br>
                        <span>Wali Kelas</span>
                        <br><br><br><br><br><br><br>
                        <strong>{{$w->nama ?? "______________________________" }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span>Mengetahui, </span>
                        <br>
                        Kepala Sekolah {{$sekolah->nama_sekolah}}
                        <br><br><br><br><br><br><br>
                        <strong>{{$ks->nama ?? "______________________________" }}</strong>
                    </td>
                </tr>
            </thead>
        </table>
        {{-- / Tanda Tangan --}}
    </div>
</body>
</html>
