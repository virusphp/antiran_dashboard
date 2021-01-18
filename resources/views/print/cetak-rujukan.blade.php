<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SURAT RUJUKAN PESERTA</title>
    <style type="text/css">
        h4 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }       
      
        .ttd-garis{
            border-bottom: 2px solid;
        }
        
        .table-content {
            border-spacing: 0;
            /* width: 100%; */
        }
    
        @page {
            margin-top: 10px;
            martin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
        }

        @font-face {
            font-family: 'DOTMATRI';
            src: {{ asset('font-dotmatrix/DOTMATRI.ttf') }};
            src: local('DOTMATRI'), url('./DOTMATRI.woff') format('woff'), url('./DOTMATRI.ttf') format('truetype');
        }

        @media print {
            body {
                font-size: 11pt;
                font-family: "Arial";
            }
        }

        @media screen {
            body {
                font-size: 11pt;
                font-family: "Arial";
            }
        }
        
        body {
            background : #ffffff;
            color: #000000;
            margin: 10px 5px 5px 10px;
            font-family: "Arial";
            font-size:11px;
            padding: 1px;
        }
        
        table tr td {
            font-size: 11pt;
            font-family:'Arial';
            padding: 1px;
        }

        i , i strong {
            font-size: 10px;
            vertical-align: top;
        }
     
        #sep-image {
            width: 5%;
            vertical-align: top;
        }

        .avatar-view {
            width: 170px;
            height: 25px;
        }

        #sep-title {
            margin-top: 1px;
            padding-left: 5em;
            font-size: 19px;
        }
        #sep-title-2 {
            padding-left: 6.6em;
            font-size: 17px;
        }
       #tgl-sep .tgl-sep, #tgl-sep .tgl-lahir, .no-rm, .tindakan, .ttd-pasien{
            width: 15%;
        }
        #tgl-sep .nilai-tgl-sep, .nilai-no-rm, .ttd-dokter, .g-2 .ttd-garis, #v-noSep, {
            width: 35%;
        }
        #tgl-sep .nilai-tgl-lahir, .kel-pas, .g-1{
            width: 20%;
        }
        #tgl-sep .jns-kel, #tgl-sep .nilai-jns-kel {
            width: 10%;
        }

        .asal-fks {
            width: 18%;
        }
        
        .nilai-poli {
            width: 33%;
        }

        .no-rm, .nilai-no-rm, .alamat-p, .nilai-alamat-p, .tt-dua, .asal-fks, .nama-fks, .diagnosa, .nilai-diagnosa, .catatan, .n-catatan{
            vertical-align: top;
        }

        .blanked {
            width: 35%;
        }

        .kanan {
            font-size: 11px;
        }
 
    </style>
</head>
<body id="sep-content" onload="printSep();">
    <table class="table table-borderless table-header" >
        <tr>
            <td id="sep-image" rowspan="2"><img class="img-responsive avatar-view"  src="{{ asset('img/logo-bpjs.png') }}"></td>
            <td id="sep-title">
                SURAT RUJUKAN PESERTA 
            </td> 
        </tr> 
        <tr>
            <td id="sep-title-2">RSUD KRATON Pekalongan</td>
        </tr> 
        <tr style="width:50px">
            <td colspan="2"></td>                            
        </tr>                       
    </table>
    <table class="table table-content">
        {{-- <tr>
            <td style="padding-left: 20em">{!! DNS1D::getBarcodeHTML($dataRujukan->no_rujukan, "C128",1.4,22) !!}</td>
        </tr> --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">No. {{ $dataRujukan->no_rujukan }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">Tgl. {{ $dataRujukan->tgl_rujukan }}</td>
        </tr>
    </table>   
    <table class="table table-content">
        <tr>
            <td style="width: 200px">Kepada Yth</td>
            <td>: </td>
            <td>{{ $dataRujukan->nama_poli }}</td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
            <td>{{ $dataRujukan->nama_tujuan_rujukan }}</td>
        </tr>
        <tr>
            <td colspan="3">Memohon Pemeriksaan dan Penanganan Lebih Lanjut : <span style="padding-left: 15em">{{ tipeRujukan($dataRujukan->tipe_rujukan) }} | {{ jenisPelayanan($dataRujukan->jns_pelayanan) }}</span> </td>
        </tr>
        <tr>
            <td>No Kartu</td>
            <td>:</td>
            <td>{{ $dataRujukan->no_kartu }}</td>
        </tr>
        <tr>
            <td>Nama Peserta</td>
            <td>:</td>
            <td>{{ $dataRujukan->nama_peserta }}</td>
        </tr>
        <tr>
            <td>Tgl Lahir</td>
            <td>:</td>
            <td>{{ $dataRujukan->tgl_lahir }}</td>
        </tr>
        <tr>
            <td>Diagnosa</td>
            <td>:</td>
            <td>{{ $dataRujukan->nama_diagnosa }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $dataRujukan->catatan }}</td>
        </tr>
        <tr>
            <td colspan="3"> Demikian atas bantuannya diucapkan banyak terimakasih.</td>
        </tr>
    </table>
    <table class="table table-ttd">
        <tr>
            <td style="height:105px" colspan="6"></td>
        </tr>
        <tr class="ttd">
            <td sytle="vertical-align: top;"></td>
            <td style="width:20%"></td>
            <td style="width:20%"></td>
            <td style="width:15%" class="ttd-pasien">Mengetahui</td>
        </tr>
        <tr>
            <td style="height:30px" colspan="6"></td>
        </tr>
        <tr class="ttd-ttd">
            <td sytle="vertical-align: top;"></td>
            <td style="width:20%"></td>
            <td style="width:20%"></td>
            <td style="width:15%" class="ttd-garis"></td>
        </tr>
        <tr>
            <td colspan="3"> 
                <i>
                    *Rujukan Berlaku sampai Dengan x 2021
                     <br>*Tgl Rencana Berkunjung Januari 2021
                </i>
            </td>
            <td class="kanan">Dicetak Oleh : {{ Auth::user()->nama_pegawai }}</td>
        </tr>
    </table>
</body>
</html>
<script>
    function printSep(){           
        window.print();
        window.focus();
        setTimeout(window.close, 0);
    }   
</script>