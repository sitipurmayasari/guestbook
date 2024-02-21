<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Data Absensi</title>
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
            DAFTAR HADIR <br>
            {{$data->name}} <br>
            @if ($data->datefrom != $data->dateto)
                {{tgl_indo($data->datefrom)}} s/d {{tgl_indo($data->dateto)}}
            @else
                {{tgl_indo($data->datefrom)}}
            @endif
            
        </h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                Hari/Tanggal :
                @php
                    $a = strtotime($tgl);
                    $c = date('D', $a);
                    if ($c=='sun') {
                    $days='Minggu';
                    }else if ($c=='Mon') {
                        $days='Senin';
                    }else if ($c=='Tue') {
                        $days='Selasa';
                    }else if ($c=='Wed') {
                        $days='Rabu';
                    }else if ($c=='Thu') {
                        $days='Kamis';
                    }else if ($c=='Fri') {
                        $days='Jumat';
                    }else{
                        $days='Sabtu';
                    };
                @endphp
                {{$days}}, {{tgl_indo($tgl)}}
            </div>
        </div>

        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PEGAWAI</th>
                    <th>ASAL</th>
                    <th>JABATAN</th>
                    <th>TANDA TANGAN</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($detail as $row)
                    <tr>
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td>{{ $row->participant_name }}</td>
                        <td>
                            @if ($row->unit != null)
                               {{$row->unit}} 
                            @else
                                {{$row->instansi}}
                            @endif
                        </td>
                        <td>{{$row->position}}</td>
                        <td style="text-align: center; padding-top: 5px;">
                            <img src="{{ $row->sign}}" alt="" width="75px">
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
