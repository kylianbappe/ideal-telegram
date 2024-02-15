<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Pemeriksaan Pasien Admedika</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <!-- Admedika Tahap Satu -->
            <div class="table-container-tahapsatu">
                <span class="heading-pemeriksaan-pasien">Pemeriksaan Pasien Dokter Gigi</span>
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <span class="titleSoap">Nama Pasien</span>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->nama }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <span class="titleSoap">No. Kartu Pasien</span>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->nkp }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <span class="titleSoap">Tanggal Lahir</span>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->lahir }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <span class="titleSoap">Jenis Pasien</span>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $antrian->jenis }}</span>
                        </div>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="bottom-form-admedika">
                   <div class="left">
                        <div class="boxform">
                            <span class="titleSoap">Dokter</span>
                            <div class="spanDokter">
                                <span type="text" placeholder="Nama Pengguna" class="namaDokter">{{ Auth::user()->nama }}</span>
                            </div>
                        </div>
                   </div>
                   <div class="right">
                        <div class="tindakanSOAP">
                            Catatan Tindakan Gigi dan SOAP
                        </div>
                   </div>
                </div>
                <form action="/buat-soap" method="POST">
                @csrf
                    <input type="hidden" name="pasien" id="pasienInput" value="{{ $pasien->nama }}">
                    <input type="hidden" name="subjektif" id="subjektifInput">
                    <input type="hidden" name="objektif"  id="objektifInput">
                    <input type="hidden" name="assesment" id="assesmentInput">
                    <input type="hidden" name="plan"  id="planInput">
                    <input type="hidden" name="tindakan"  id="tindakanInput">
                    <input type="hidden" name="biaya"  id="biayaInput">
                    <input type="hidden" name="reminder"  id="reminderInput">
                    <input type="hidden" name="antrian-id"  value="{{ $antrianId }}">
                    <input type="hidden" name="jenis" value="{{ $antrian->jenis }}">
                    <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $today = new DateTime('now');
                                $formattedDate = $today->format('d/m/Y');
                    ?>
                    <input type="hidden" name="tanggal" value="{{ $formattedDate }}" id="tanggalInput">
                    <div class="submitForm">
                        <button class="submitAdmedika">Submit</button>
                    </div>
                </form>
            </div>
            <!-- Admedika Tahap Dua -->
            <div class="table-container-tahapdua">
                <span class="heading-pemeriksaan-pasien">Tindakan Gigi</span>
                <div class="border-pertabel"></div>
                    <div class="parent-tindakan">
                        <div class="container-tind-gigi-tindakan">
                            <div class="item-tindakan">
                                <span class="titleSoap" style="margin-top: 7px;">Jenis Tindakan</span>
                                <div class="parent-dd">
                                    <div class="dropdown">
                                        <span>Pilih</span>
                                        <div class="iconfa">
                                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-tindakan">
                                <span class="titleSoap" style="margin-top: 7px;">Jumlah Harga</span>
                                <div class="spanGray">
                                    <input type="number" placeholder="Tulis (jika disc)" class="jumlahTindakan" id="jumlahHarga" onchange="diskonHarga(this)">
                                </div>
                            </div>
                        </div>
                        <div class="container-tind-gigi-tindakan2">
                    <div class="selectOption">
                                        <div class="choice">
                                            <input type="checkbox" value="Tidak Ada" data-price="0" onchange="check(this, this)"/>
                                            <label for="">Tidak Ada</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konsultasi" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Konsultasi - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Pembersihan Karang Gigi" data-price="3000000" onchange="check(this, this)"/>
                                            <label for="">Pembersihan Karang Gigi - Rp 3.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Abses" data-price="6000000" onchange="check(this, this)"/>
                                            <label for="">Bedah Abses - Rp 6.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Xray" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Xray - Rp 150.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Peresepan Obat" data-price="100000" onchange="check(this, this)"/>
                                            <label for="">Peresepan Obat - Rp 100.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Scalling + Flour Application" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Anak - Scalling + Flour Application - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Pencabutan Gigi Anak" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Anak - Pencabutan Gigi Anak - Rp 150.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Pencabutan Gigi Anak" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Anak - Pencabutan Gigi Anak - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Penambalan Gigi Anak (RK/GIC)" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Anak - Penambalan Gigi Anak (RK/GIC) - Rp 150.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Penambalan Gigi Anak (RK/GIC)" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Anak - Penambalan Gigi Anak (RK/GIC) - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Perawatan Gigi Depan Anak (3x Perawatan sampai tambal)" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Anak - Perawatan Gigi Depan Anak (3x Perawatan sampai tambal) - Rp 150.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Anak - Perawatan Gigi Depan Anak (3x Perawatan sampai tambal)" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Anak - Perawatan Gigi Depan Anak (3x Perawatan sampai tambal) - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Pembersihan Karang Gigi Klas I" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Pembersihan Karang Gigi Klas I - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Pembersihan Karang Gigi Klas II" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Pembersihan Karang Gigi Klas II - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Pembersihan Karang Gigi Klas III" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Pembersihan Karang Gigi Klas III - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Flour Application (Vitamin Gigi 5 mnt)" data-price="100000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Flour Application (Vitamin Gigi 5 mnt) - Rp 100.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Gingivektomi {pergigi}" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Gingivektomi {pergigi} - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Kuretase {pergigi}" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Kuretase {pergigi} - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Spinting Fiber /Gigi {pergigi}" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Spinting Fiber /Gigi {pergigi} - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Periodonti - Spinting Kawat {pergigi}" data-price="100000" onchange="check(this, this)"/>
                                            <label for="">Periodonti - Spinting Kawat {pergigi} - Rp 100.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan Biasa (sisa akar / gigi depan )" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan Biasa (sisa akar / gigi depan ) - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan Biasa (sisa akar / gigi depan )" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan Biasa (sisa akar / gigi depan ) - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan geraham / komplikasi" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan geraham / komplikasi - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan geraham / komplikasi" data-price="500000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan geraham / komplikasi - Rp 500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan M3 RA klas 1A tanpa bedah" data-price="500000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan M3 RA klas 1A tanpa bedah - Rp 500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Pencabutan M3 RA klas 1A tanpa bedah" data-price="750000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Pencabutan M3 RA klas 1A tanpa bedah - Rp 750.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Operasi Geraham 3 / operasi minor" data-price="1000000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Operasi Geraham 3 / operasi minor - Rp 1.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Operasi Geraham 3 / operasi minor" data-price="2000000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Operasi Geraham 3 / operasi minor - Rp 2.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Trepanasi Abses / Trepanasi" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Trepanasi Abses / Trepanasi - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Hecting Benang Nylon / benang" data-price="100000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Hecting Benang Nylon / benang - Rp 100.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Bedah Mulut - Hecting Benang Nylon / benang" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Bedah Mulut - Hecting Benang Nylon / benang - Rp 150.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - Tambal Gigi Komposit" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - Tambal Gigi Komposit - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - Tambal Gigi Komposit" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - Tambal Gigi Komposit - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - T.Komposit Anterior / Klas 2 Besar" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - T.Komposit Anterior / Klas 2 Besar - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - T.Komposit Anterior / Klas 2 Besar" data-price="500000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - T.Komposit Anterior / Klas 2 Besar - Rp 500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - T.Komposit + Pulp Caping direct" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - T.Komposit + Pulp Caping direct - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - T.GIC" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - T.GIC - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - T.GIC" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - T.GIC - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - Veneer Direct" data-price="500000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - Veneer Direct - Rp 500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Konservasi Gigi - Veneer Direct" data-price="700000" onchange="check(this, this)"/>
                                            <label for="">Konservasi Gigi - Veneer Direct - Rp 700.000</label>
                                        </div>        
                                        <div class="choice">
                                            <input type="checkbox" value="Bleaching Extracorona RA&RB USA Agent (free scalling)" data-price="2000000" onchange="check(this, this)"/>
                                            <label for="">Bleaching Extracorona RA&RB USA Agent (free scalling) - Rp 2.000.000</label>
                                        </div>        
                                        <div class="choice">
                                            <input type="checkbox" value="Diamond / Permata gigi" data-price="150000" onchange="check(this, this)"/>
                                            <label for="">Diamond / Permata gigi - Rp 150.000</label>
                                        </div>        
                                        <div class="choice">
                                            <input type="checkbox" value="Bleaching Extracorona RA&RB USA Agent (free scalling)" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Bleaching Incra corona (perkunjungan) - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="GTC PFM (termasuk crown sementara)" data-price="2200000" onchange="check(this, this)"/>
                                            <label for="">GTC PFM (termasuk crown sementara) - Rp 2.200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - Inlay Komposit" data-price="35000000" onchange="check(this, this)"/>
                                            <label for="">GTC Emax/zirconia (termasuk crown sementara) - Rp 3.500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="GTSL (basis Valplast + Gigi Pertama)" data-price="1500000" onchange="check(this, this)"/>
                                            <label for="">GTSL (basis Valplast + Gigi Pertama) - Rp 1.500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - Inlay Komposit" data-price="1000000" onchange="check(this, this)"/>
                                            <label for="">GTSL (basis Akrilik + Gigi Pertama) - Rp 1.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - Inlay Komposit" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">GTSL (tambahan Per-gigi) - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - Inlay Komposit" data-price="1200000" onchange="check(this, this)"/>
                                            <label for="">Gigi Palsu - Inlay Komposit - Rp 1.200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - GTKL (Basis Logam + Gigi Pertama)" data-price="2250000" onchange="check(this, this)"/>
                                            <label for="">Gigi Palsu - GTKL (Basis Logam + Gigi Pertama) - Rp 2.250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - Gigi Tiruan Penuh /GTP {/rahang}" data-price="2500000" onchange="check(this, this)"/>
                                            <label for="">Gigi Palsu - Gigi Tiruan Penuh /GTP {/rahang} - Rp 2.500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Gigi Palsu - GTP Komplikasi (linggir landal) {/rahang}" data-price="3500000" onchange="check(this, this)"/>
                                            <label for="">Gigi Palsu - GTP Komplikasi (linggir landal) {/rahang} - Rp 3.500.000</label>
                                        </div>  
                                        <div class="choice">
                                            <input type="checkbox" value="Pemasangan Behel Metal RA dan RB" data-price="4000000" onchange="check(this, this)"/>
                                            <label for="">Pemasangan Behel Metal RA dan RB - Rp 4.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Pemasangan Behel Ceramic (RA dan RB)" data-price="4500000" onchange="check(this, this)"/>
                                            <label for="">Pemasangan Behel Ceramic (RA dan RB) - Rp 4.500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Pemasangan Self Ligating (RA dan RB)" data-price="6000000" onchange="check(this, this)"/>
                                            <label for="">Pemasangan Self Ligating (RA dan RB) - Rp 6.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Pemasangan Saphire Braces (RA dan RB)" data-price="7000000" onchange="check(this, this)"/>
                                            <label for="">Pemasangan Saphire Braces (RA dan RB) - Rp 7.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Kontrol" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Kontrol - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Lem Bracket Lepas (garansi 1 minggu)" data-price="50000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Lem Bracket Lepas (garansi 1 minggu) - Rp 50.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Ganti Bracket baru /pcs" data-price="100000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Ganti Bracket baru /pcs - Rp 100.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Ganti Bracket baru self ligating / saphire" data-price="300000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Ganti Bracket baru self ligating / saphire - Rp 300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Melepas Bracket (lepas + scalling + polish)" data-price="500000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Melepas Bracket (lepas + scalling + polish) - Rp 500.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Retainer {1 rahang}" data-price="750000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Retainer {1 rahang} - Rp 750.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Retainer {2 rahang}" data-price="1400000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Retainer {2 rahang} - Rp 1.400.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Orthodonti - Paket lepas bracket + scalling + retainer {all in}" data-price="1600000" onchange="check(this, this)"/>
                                            <label for="">Orthodonti - Paket lepas bracket + scalling + retainer {all in} - Rp 1.600.000</label>
                                        </div>   
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {gigi depan / 1 saluran}" data-price="1800000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {gigi depan / 1 saluran} - Rp 1.800.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {geraham kecil}" data-price="2000000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {geraham kecil} - Rp 2.000.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {geraham besar}" data-price="2300000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Perawatan Saluran Akar Paket (PSA + Tambal + Xray before + Xray after) {geraham besar} - Rp 2.300.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Perawatan Saluran Akar (Total 4 kunjungan sudah termasuk tambal, free xray before) {gigi depan/1 saluran}" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Perawatan Saluran Akar (Total 4 kunjungan sudah termasuk tambal, free xray before) {gigi depan/1 saluran} - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Perawatan Saluran Akar (Total 4 kunjungan sudah termasuk tambal, free xray before) {Geraham kecil}" data-price="400000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Perawatan Saluran Akar (Total 4 kunjungan sudah termasuk tambal, free xray before) {Geraham kecil} - Rp 400.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Trepanasi Radiks" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Trepanasi Radiks - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Eugenol + cavit" data-price="250000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Eugenol + cavit - Rp 250.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Dressing tambahan" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Dressing tambahan - Rp 200.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Pasak" data-price="350000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Pasak - Rp 350.000</label>
                                        </div>
                                        <div class="choice">
                                            <input type="checkbox" value="Perawatan Saluran Akar - Pulp Caping Indiret" data-price="200000" onchange="check(this, this)"/>
                                            <label for="">Perawatan Saluran Akar - Pulp Caping Indiret - Rp 200.000</label>
                                        </div>   
                                    </div>
                    </div>
                    
                    </div>
                    <span class="heading-pemeriksaan-pasien">SOAP</span>
                    <div class="border-pertabel"></div>
                    <div class="container-soap">
                        <div class="child-soap">
                            <div class="tindakanGigi">
                                <div class="itemTindakanGigi">
                                    <span class="titleSoap">Subjective</span>
                                    <div class="container-spanAdmedika">
                                            <textarea type="text" class="soap" onchange="handleSubjektif(this)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tindakanGigi">
                                <div class="itemTindakanGigi">
                                    <span class="titleSoap">Objective</span>
                                    <div class="container-spanAdmedika">
                                            <textarea type="text" class="soap" onchange="handleObjektif(this)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tindakanGigi">
                                <div class="itemTindakanGigi">
                                    <span class="titleSoap">Assesment</span>
                                    <div class="container-spanAdmedika">
                                            <textarea type="text" class="soap" onchange="handleAssesment(this)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tindakanGigi">
                                <div class="itemTindakanGigi">
                                    <span class="titleSoap">Plan</span>
                                    <div class="container-spanAdmedika">
                                            <textarea type="text" class="soap" onchange="handlePlan(this)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="calendar-container">
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <input type="checkbox" style="width: 20px; height: 20px;" onchange="reminder(this)">
                                <label>Masukkan ke daftar riwayat setelah 6 bulan</label>
                            </div>
                            <img src="{{ asset('/img/calendar.png') }}" class="cldnr"/>
                        </div>
                    </div>
                    <div class="submitFormTahapDua">
                        <button class="submitAdmedika">DONE</button>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- MODAL -->
<script>
    const catatanSoap = document.querySelector('.right');
    const doneCatatan = document.querySelector('.submitFormTahapDua');
    const tahapSatu = document.querySelector('.table-container-tahapsatu');
    const tahapDua = document.querySelector('.table-container-tahapdua');
    
    catatanSoap.addEventListener("click", () => {
        tahapSatu.style.display = 'none';
        tahapDua.style.display = 'block';
    })

    doneCatatan.addEventListener("click", () => {
        tahapDua.style.display = 'none';
        tahapSatu.style.display = 'block';
    })


</script>



<script>
    let clicked = false;
    const dd = document.querySelector('.dropdown');
    const pdd = document.querySelector('.parent-dd');
    const so = document.querySelector('.selectOption')
    dd.addEventListener("click", (e) => {
        if (clicked === false) {
            clicked = true;
            pdd.style.height = "200px"
            so.style.display = "block"
        } else {
            clicked = false;
            pdd.style.height = "100%"
            so.style.display = "none"
        }
    })


    //SOAP
    const jumlahId = document.getElementById('jumlahHarga');
    const pasienId = document.getElementById('pasienInput');
    const subjektifId = document.getElementById('subjektifInput');
    const objektifId = document.getElementById('objektifInput');
    const assesmentId = document.getElementById('assesmentInput');
    const planId = document.getElementById('planInput');
    const tindakanId = document.getElementById('tindakanInput');
    const biayaId = document.getElementById('biayaInput');
    const tanggalId = document.getElementById('tanggalInput');
    const noresepId = document.getElementById('noresepInput');


    let tindakan = [];
    let hargaPerTindakan = [];
    function check(checkbox, e) {
        const price = parseFloat(e.getAttribute('data-price'));
        if (checkbox.checked) {
            hargaPerTindakan.push(price);
            tindakan.push(e.value)
            biayaId.value = JSON.stringify(hargaPerTindakan);
            tindakanId.value = JSON.stringify(tindakan);
            console.log(hargaPerTindakan)
            // console.log('value of biaya: ', biayaId.value)
            // console.log('value of tindakan: ', tindakanId.value)
            // console.log(total)
            // console.log(tindakan)
            // console.log("checked!")
        } else {
            hargaPerTindakan = hargaPerTindakan.filter((i) => i !== price)
            tindakan = tindakan.filter((i) => i !== e.value)
            biayaId.value = JSON.stringify(hargaPerTindakan);
            tindakanId.value = JSON.stringify(tindakan);
            console.log(hargaPerTindakan)
            // console.log('value of biaya: ', biayaId.value)
            // console.log('value of tindakan: ', tindakanId.value)
            // console.log('removed :', tindakan)
            // console.log('calculated :', total)
            // console.log("not checked!")
        }
    // console.log('now: ', total);
    // console.log('now: ', tindakan);
    }

    function convertToTindakanArray(text) {
        return text.split('\n').map(item => item.trim()).filter(item => item !== '');
    }

    function handleSubjektif(e) {
        const formatted = convertToTindakanArray(e.value)
        subjektifId.value = JSON.stringify(formatted);
        // console.log(convertToTindakanArray(e.value))
        // console.log('s: ', subjektifId.value)
    }
    function handleObjektif(e) {
        const formatted = convertToTindakanArray(e.value)
        objektifId.value = JSON.stringify(formatted);
        // console.log('o: ', objektifId.value)
    }
    function handleAssesment(e) {
        const formatted = convertToTindakanArray(e.value)
        assesmentId.value = JSON.stringify(formatted);
        // console.log('a: ', assesmentId.value)
    }
    function handlePlan(e) {
        const formatted = convertToTindakanArray(e.value)
        planId.value = JSON.stringify(formatted);
        // console.log('p: ', planId.value)
    }

 
    function diskonHarga(e) {
        if (e.value !== "") {
            biayaId.value = e.value;
        }else {
            biayaId.value = total;
        }
        console.log(e.value)
    }

    const reminderValue = document.getElementById('reminderInput')
    const reminderId = document.querySelector('.cldnr')
    function reminder(e) {
        if (e.checked) {
            reminderValue.value = 1;
            // console.log(true)
            reminderId.style.backgroundColor = "rgba(0,0,0,0.2)"
        }else {
            reminderValue.value = 0;
            // console.log(false)
            reminderId.style.backgroundColor = ""
        }
    }
   
    
    
</script>