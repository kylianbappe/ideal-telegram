<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Laporan Pembukuan Transaksi</title>
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
                        <h1 class="heading-pemeriksaan-pasien">Pembukuan Transaksi Klinik Bulan {{ $bulan}} {{ $tahun}}</h1>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="laporan-section">
                    <div style="margin-right: 5px; width: 13%;">
                        <span class="judul">No. Kartu Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 17%;">
                        <span class="judul">Nama Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 13%;">
                        <span class="judul">Tanggal Periksa</span>
                    </div>
                    <div style="margin-right: 5px; width: 12%;">
                        <span class="judul">Jenis Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="judul">Tindakan</span>
                    </div>
                    <div style="margin-right: 5px; width: 10%;">
                        <span class="judul">Biaya</span>
                    </div>
                    <div style="margin-right: 5px; width: 10%;">
                        <span class="judul">Total</span>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="items-hehr">
                @foreach ($dataPembukuan as $dataPatient)
                <div class="cont-hehr">
                    <div class="laporan-section">
                        <div style="margin-right: 5px; width: 13%;">
                            <span class="nkp">{{ $dataPatient->nkp }}</span>
                        </div>
                        <div style="margin-right: 5px; width: 17%;">
                            <span class="nama">{{ $dataPatient->pasien }}</span>
                        </div>
                        <div style="margin-right: 5px; width: 13%;">
                            <span class="nama">{{ $dataPatient->tanggal }}</span>
                        </div>
                        <div style="margin-right: 5px; width: 12%;">
                            <span class="nama">{{ $dataPatient->jenis_pasien }}</span>
                        </div>
                        <div style="margin-right: 5px; width: 15%;">
                            @php
                                $tindakanArray = json_decode( $dataPatient->tindakan, true);
                            @endphp
                            @if (count($tindakanArray) == 1)
                                <span class="nama">{{ $tindakanArray[0] }}</span>
                            @else
                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                @foreach ($tindakanArray as $tindakan)
                                <span class="nama">{{ $tindakan }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div style="margin-right: 5px; width: 10%;">
                        @php
                            $decodeBiaya = json_decode($dataPatient->biaya, true);
                            $total = array_sum($decodeBiaya);
                        @endphp
                        @if (count($decodeBiaya) == 1)
                            <span class="nama">Rp {{ number_format($decodeBiaya[0], 0, ',', '.') }}</span>
                        @else
                        <div  style="display: flex; flex-direction: column; gap: 15px;">
                            @foreach ($decodeBiaya as $manyBiaya)
                                <span class="nama">Rp {{ number_format($manyBiaya, 0, ',', '.') }}</span>
                            @endforeach
                        </div>
                        @endif
                        </div>
                        <div style="margin-right: 5px; width: 10%;">
                            <span class="nama">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('dapatkanInvoice', ['id' => $dataPatient->invoice_id, 'nama' => $dataPatient->pasien]) }}" style="text-decoration: none; color: black; margin-right: 25px;">
                            <div class="item-p-c">
                                <img src="{{ asset('/img/zoom.png') }}" class="delete" style="height: 30px; width: 30px; cursor: pointer;"/>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>