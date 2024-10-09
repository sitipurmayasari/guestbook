<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Data Pelatihan</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" />
    <style type="text/css">
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
        }

        @media screen {
            div.divFooter {
                display: none;
            }
        }

        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0.6cm;
                text-align: right;

            }

            .noPrint {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <section class="sheet padding-5mm">

        <hr>
        <h2 style="text-align: center;">
            LAPORAN DATA PENGUNJUNG 
            @if (request()->get('category'))
         
                @if (request()->get('category') == 1)
                    PENGUJIAN
                @elseif (request()->get('category') == 2)
                    INFORMASI
                @else
                    UMUM
                @endif
         
            @endif
            <br>
            BBPOM DI BANJARMASIN
            PERIODE  : <br>
            {{ tgl_indo(request()->get('startdate')) }}
                                @if (request()->get('enddate'))
                                    s/d {{ tgl_indo(request()->get('enddate')) }}
                                @endif
        </h2>
        <br>
        @php
           
            
        @endphp

        
        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Telp</th>
                    @if (request()->get('category') == 2)
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Pekerjaan</th>
                    @endif
                    <th>Waktu Kunjungan</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td style="text-align: center">{{ $no++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->origin }}</td>
                        <td>{{ $row->purpose }}</td>
                        <td>
                            @if ($row->gender == "P")
                                Perempuan
                            @else
                                Laki - Laki
                            @endif
                        </td>
                        <td>{{$row->age}} th</td>
                        <td>{{ $row->telp }}</td>
                        @if (request()->get('category') == 2)
                            <td>{{$row->email}}</td>
                            <td>{{$row->school}}</td>
                            <td>{{$row->work}}</td>
                        @endif
                        <td>{{ $row->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
