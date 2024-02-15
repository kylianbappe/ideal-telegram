<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Daftar Pasien 6 Bulan</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Daftar Pasien Yang Belum Datang Selama 6 Bulan Terakhir</span>
                <div class="border-pertabel"></div>
                <div class="jumlah-baris">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div class="itemOne">
                                <span class="judul">No. Telp</span>
                            </div>
                            <div class="itemOne">
                                <span class="judul">Nama Pasien</span>
                            </div>
                        </div>
                        <div class="secondTblSection">
                            <div class="itemTwo">
                                <span class="judul">Tanggal Periksa</span>
                            </div>
                            <div class="itemTwo">
                                <span class="judul">Dokter</span>
                            </div>
                            <div class="itemTwo">
                                <span class="judul">Riwayat Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                @if ($pasien == [])
                    <div class="jumlah-baris">
                        <div class="isi-baris-norecord">
                            Pasien tidak ada!
                        </div>
                    </div>
                @else
                @foreach ($pasien as $patientName => $patientData)
                <div class="jumlah-baris">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div class="itemOne">
                                <span class="nkp">{{ $patientData['patientInfo']->telpon }}</span>
                            </div>
                            <div class="itemOne">
                                <span class="nama">{{ $patientData['patientInfo']->nama }}</span>
                            </div>
                        </div>
                        <div class="secondTblSection">
                            <div class="itemTwo">
                                <span class="tgl">{{ $patientData['newestSoapRecord']->tanggal }}</span>
                            </div>
                            <div class="itemTwo">
                                <span class="dokter">{{ $patientData['patientInfo']->dokter }}</span>
                            </div>
                            <a href="{{ route('nambulanSoap', ['id' => $patientData['newestSoapRecord']->id, 'nama' => $patientData['patientInfo']->nama]) }}" style="text-decoration: none; color: black;">
                                <div class="itemTwo">
                                    <span class="petunjuk">Lihat</span>
                                </div>
                            </a>
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