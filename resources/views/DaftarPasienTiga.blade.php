<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Detail Riwayat</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Riwayat Pasien Dokter Gigi</span>
                <div class="border-pertabel"></div>
                <div class="data-pasien-dr">
                    <div class="wrapper-data-pasien">
                        <label for=""><strong>Nama Pasien</strong> : {{ $datapasien->nama}}</label>
                    </div>
                    <div class="wrapper-data-pasien">
                        <label for=""><strong>Nomor NIK</strong> : {{ $datapasien->nik}}</label>
                    </div>
                    <div class="wrapper-data-pasien">
                        <label for=""><strong>No. Kartu Pasien</strong> : {{ $datapasien->nkp}}</label>
                    </div>
                    <div class="wrapper-data-pasien">
                        <label for=""><strong>Jenis Kelamin</strong> : {{ $datapasien->kelamin}}</label>
                    </div>
                    <div class="wrapper-data-pasien">
                        <label for=""><strong>No. Telp</strong> : {{ $datapasien->telpon}}</label>
                    </div>
                </div>
                @if ($datasoap == "Belum memiliki riwayat") 
                    <div class="jumlah-baris" style="text-align: center;">Pasien belum memiliki riwayat dokter gigi</div>
                @else
                <div class="border-pertabel"></div>
                <div class="jumlah-baris">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div style="width: 13%;">
                                <span class="judul">Tanggal</span>
                            </div>
                            <div style="width: 15%;">
                                <span class="judul">No. Resep</span>
                            </div>
                            <div style="width: 18%;">
                                <span class="judul">Dokter</span>
                            </div>
                            <div style="width: 18%;">
                                <span class="r-soap">SOAP</span>
                            </div>
                            <div style="width: ;">
                                <span class="r-tindakan">Tindakan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                @foreach ($totalSoap as $soap)
                <div class="jumlah-baris">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div style="width: 13%;">
                                <span class="nkp">{{ $soap->tanggal}}</span>
                            </div>
                            <div style="width: 15%;">
                                <span class="nama">{{ $soap->noresep}}</span>
                            </div>
                            <div style="width: 18%;">
                                <span class="">{{ $soap->dokter}}</span>
                            </div>
                            <div style="width: 18%;">
                                @php
                                    $decodingSoap = json_decode($soap->subjektif, true);
                                @endphp
                                @if (count($decodingSoap) == 1)
                                    <span class="">{{ $decodingSoap[0]}}</span>
                                @else
                                <div class="scrollable-column">
                                        <span class="">* Pasien mengalami</span>
                                    @foreach ($decodingSoap as $soapArray)
                                        <span class="">- {{ $soapArray}}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div style="width: ;">
                                @php
                                    $decodingTindakan = json_decode($soap->tindakan, true);
                                @endphp
                                @if (count($decodingTindakan) == 1)
                                    <span class="">{{ $decodingTindakan[0]}}</span>
                                @else
                                <div class="scrollable-column">
                                    @foreach ($decodingTindakan as $tindakan)
                                        <span class="">{{ $tindakan}}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>