<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Daftar Pasien</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Daftar Pasien Dokter Gigi</span>
                <div class="filter-container">
                    <div class="search-box-filter">
                        <input type="text" placeholder="Cari Pasien" class="reset-password">
                    </div>
                    <button class="submit-rp">Search</button>
                </div>
                <div class="border-pertabel"></div>
                <div class="laporan-section">
                    <div style="margin-right: 5px; width: 25%;">
                        <span class="judul">No. Kartu Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 20%;">
                        <span class="judul">Nama Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="judul">Tanggal Lahir</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="judul">Riwayat Pasien</span>
                    </div>
                    <div style="margin-right: 5px;">
                        <span class="judul">Input Pasien</span>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                @if ($daftarPasien->isEmpty())
                    <div class="jumlah-baris">
                        <div class="isi-baris-norecord">
                            Tidak ada pasien!
                        </div>
                    </div>
                @else
                @foreach ($daftarPasien as $pasien)
                <div class="jumlah-baris pasien-row" data-pasien-id="{{ $pasien->id }}" data-name="{{ $pasien->nama ?? '' }}">
                    <div class="isi-baris">
                        <div class="firstTblSection">
                            <div style="margin-right: 5px; width: 25%;">
                                <span class="nkp">{{ $pasien->nkp}}</span>
                            </div>
                            <div style="margin-right: 5px; width: 20%;">
                                <span class="nama">{{ $pasien->nama}}</span>
                            </div>
                            <div style="margin-right: 5px; width: 16.5%;">
                                <span class="nama">{{ $pasien->lahir}}</span>
                            </div>
                            <div style="margin-right: 5px; width: 14.5%;">
                                <a href="{{ route('cekriwayatpasien', ['id' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                    <span class="periksa">Lihat</span>
                                </a>
                            </div>
                            <div style="margin-right: 5px; width: 6%;">
                                <a href="{{ route('inputpasien', ['id' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                    <span class="periksa">Input</span>
                                </a>
                            </div>
                            <div class="item-p-c">
                                <a href="{{ route('edit-pasien', ['id' => $pasien->id]) }}" style="text-decoration: none; color: black;">
                                    <img src="{{ asset('/img/pencil.png') }}" style="height: 25px; width: 25px; cursor: pointer;"/>
                                </a>
                                <img src="{{ asset('/img/cross.png') }}" id="delete" class="delete" style="height: 25px; width: 25px; cursor: pointer;"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-warning" id="modal{{ $pasien->id }}">
                    <div class="modal-item">
                        <span style="font-size: 22px">Hapus Pasien?</span>
                        <form action="{{ route('hapusPasien', ['id' => $pasien->id ]) }}" method="POST" style="display: flex; align-items: center; gap: 15px;">
                        @csrf
                        @method('DELETE')
                            <div class="modal-btns">
                                <button type="submit" class="modal">Hapus</button>
                                <button type="button" class="modal cancel" id="tidak">Tidak</button>
                            </div>
                        </form>
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
        document.querySelectorAll('.delete').forEach(deleteBtn => {
            deleteBtn.addEventListener('click', function() {
                const modalId = '#modal' + this.closest('.jumlah-baris').dataset.pasienId;
                const modal = document.querySelector(modalId);
                modal.style.display = 'flex';
            });
        });

        document.querySelectorAll('.cancel').forEach(cancelBtn => {
            cancelBtn.addEventListener('click', function() {
                const modal = this.closest('.modal-warning');
                modal.style.display = 'none';
            });
        });
    </script>



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
