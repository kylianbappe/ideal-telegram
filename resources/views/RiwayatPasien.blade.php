<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Riwayat Pasien</title>
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
                <div class="filter-container">
                    <div class="search-box-filter">
                        <input type="text" placeholder="Cari Pasien" class="reset-password">
                    </div>
                    <button class="submit-rp">Search</button>
                </div>
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
                        <div class="secondSectionRwt">
                            <div class="itemTwo">
                                <span class="judul">Tanggal Lahir</span>
                            </div>
                            <div class="itemTwo">
                                <span class="judul">Riwayat Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                @if (empty($pasiens))
                <div class="jumlah-baris">
                    <div class="isi-baris-norecord">
                        Tidak ada riwayat
                    </div>
                </div>
                @else
                @foreach ($pasiens as $pasien)
                <div class="jumlah-baris pasien-row" data-name="{{ $pasien->nama ?? '' }}">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div class="itemOne">
                                <span class="nkp">{{ $pasien->nkp }}</span>
                            </div>
                            <div class="itemOne">
                                <span class="nama">{{ $pasien->nama }}</span>
                            </div>
                        </div>
                        <div class="secondSectionRwt">
                            <div class="itemTwo">
                                <span class="tgl">{{ $pasien->lahir }}</span>
                            </div>
                            <a href="{{ route('detailriwayat', ['id' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                <div class="itemTwo">
                                    <span class="periksa">Lihat</span>
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


<script>
        document.querySelector('.submit-rp').addEventListener('click', function() {
            const searchValue = document.querySelector('.reset-password').value.trim().toLowerCase();
            const pasienRows = document.querySelectorAll('.pasien-row');
            
            pasienRows.forEach(row => {
                const nama = row.dataset.name.toLowerCase();
                if (nama.includes(searchValue)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>