<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Pemeriksaan Pasien</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')

        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Pemeriksaan Pasien Dokter Gigi</span>
                <div class="border-pertabel"></div>
                <div class="jumlah-baris">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div class="itemOne">
                                <span class="judul">No. Kartu Pasien</span>
                            </div>
                            <div class="itemOne">
                                <span class="judul">Nama Pasien</span>
                            </div>
                        </div>
                        <div class="secondTblSection">
                            <div class="itemTwo">
                                <span class="judul">Tanggal Lahir</span>
                            </div>
                            <div class="itemTwo">
                                <span class="judul">Jenis Pasien</span>
                            </div>
                            <div class="itemTwo">
                                <span class="judul">Periksa Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if (empty($pasiens))
                    <div class="jumlah-baris">
                        <div class="isi-baris-norecord">
                            Tidak ada pasien!
                        </div>
                    </div>
                @else
                @foreach ($pasiens as $pasien)
                <div class="jumlah-baris-pasien">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div class="itemOne">
                                <span class="nkp">{{ $pasien->nkp }}</span>
                            </div>
                            <div class="itemOne">
                                <span class="nama">{{ $pasien->nama }}</span>
                            </div>
                        </div>
                        <div class="secondTblSection">
                            <div class="itemTwo">
                                <span class="tgl">{{ $pasien->lahir }}</span>
                            </div>
                            <div class="itemTwo">
                                <span class="jenis">{{ $pasien->jenis }}</span>
                            </div>
                            <div class="itemTwo">
                                @if ($pasien->jenis == "Asuransi Admedika")
                                <a href="{{ route('admedika-tahapsatu', ['id' => $pasien->pasienId, 'antrianId' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                    <span class="periksa">Periksa Pasien</span>
                                </a>
                                @else
                                <a href="{{ route('umum-tahapsatu', ['id' => $pasien->pasienId, 'antrianId' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                    <span class="periksa">Periksa Pasien</span>
                                </a>
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