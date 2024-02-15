<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
    href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Laporan</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-laporan">
            <div class="table-container">
                <div class="text-box-laporan">
                    <div class="centering-text">
                        <h1 class="heading-pemeriksaan-pasien">Laporan Pemeriksaan Oleh Dokter Semua Jenis Pasien {{ $bulan }} {{ $tahun }}</h1>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="laporan-section">
                    <div style="width: 13%;">
                        <span class="judul">No. Kartu Pasien</span>
                    </div>
                    <div style="width: 18%;">
                        <span class="judul">Nama Pasien</span>
                    </div>
                    <div style="width: 15%;">
                        <span class="judul">Tanggal Periksa</span>
                    </div>
                    <div style="width: 15%;">
                        <span class="judul">Jenis Pasien</span>
                    </div>
                    <div style="width: 18%;">
                        <span class="judul">Tindakan</span>
                    </div>
                    <div style="width: 10%;">
                        <span class="judul">Biaya</span>
                    </div>
                    <div style="width: 10%;">
                        <span class="judul">Total</span>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="cont-hehr">
                @if (empty($pasien))
                    <span>Tidak ada laporan ditemukan!</span>
                @else
                @foreach ($pasien as $dataPasien)
                        <div class="laporan-section">
                            <div style="width: 13%;">
                                <span class="nkp">{{ $dataPasien->nkp}}</span>
                            </div>
                            <div style="width: 18%;">
                                <span class="nama">{{ $dataPasien->pasien}}</span>
                            </div>
                            <div style="width: 15%;">
                                <div class="scrollable-column">
                                        <span class="nama">{{ $dataPasien->tanggal }}</span>
                                </div>
                            </div>
                            <div style="width: 15%;">
                                <span class="nama">{{ $dataPasien->jenis_pasien}}</span>
                            </div>
                            <div style="width: 18%;">
                                    @php
                                        $tindakanArray = json_decode($dataPasien->tindakan, true);
                                    @endphp

                                    @if (count($tindakanArray) == 1)
                                        <span class="nama">{{ $tindakanArray[0] }}</span>
                                    @else
                                    <div  style="display: flex; flex-direction: column; gap: 15px;">
                                    @foreach ($tindakanArray as $manyTindakan)
                                            <span class="nama">{{ $manyTindakan }}</span>
                                    @endforeach
                                    </div>
                                    @endif
                            </div>
                            <div style="width: 10%;">
                                    <div style="margin-bottom: 20px;">
                                    @php
                                        $tindakanBiaya = json_decode($dataPasien->biaya, true);
                                    @endphp

                                    @if (count($tindakanBiaya) == 1)
                                        <span class="nama">Rp {{ number_format($tindakanBiaya[0], 0, ',', '.') }}</span>
                                    @else
                                    <div  style="display: flex; flex-direction: column; gap: 15px;">
                                    @foreach ($tindakanBiaya as $manyBiaya)
                                            <span class="nama">Rp {{ number_format($manyBiaya, 0, ',', '.') }}</span>
                                            @endforeach
                                    </div>
                                    @endif
                                    </div>
                            </div>
                            <div style="width: 10%;">
                                    <div style="margin-bottom: 20px;">
                                    @php
                                        $tindakanBiaya = json_decode($dataPasien->biaya, true);
                                        $total = array_sum($tindakanBiaya);
                                    @endphp
                                        <span class="nama">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                            </div>
                        </div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>