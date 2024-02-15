<?php
if ($antrian->jenis !== "Pasien Umum") {
    header("Location: /");
    exit; 
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Pemeriksaan Pasien Umum</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <!-- Umum Tahap Satu -->
            <div class="table-container-tahapsatu">
                <h1 class="heading-pemeriksaan-pasien">Pemeriksaan Pasien Dokter Gigi</h1>
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <h2 class="namaPasienAdmedika">Nama Pasien</h2>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->nama }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <h2 class="namaPasienAdmedika">No. Kartu Pasien</h2>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->nkp }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <h2 class="namaPasienAdmedika">Tanggal Lahir</h2>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $pasien->lahir }}</span>
                        </div>
                    </div>
                </div>
                <div class="admedika-container">
                    <div class="itemAdmedika">
                        <h2 class="namaPasienAdmedika">Jenis Pasien</h2>
                        <div class="container-spanAdmedika">
                            <span class="nama-pasienAdmedika">{{ $antrian->jenis }}</span>
                        </div>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                <div class="bottom-form-admedika">
                   <div class="left">
                        <div class="boxform">
                            <h2>Dokter</h2>
                            <div class="spanDokter">
                                <span type="text" placeholder="Nama Pengguna" class="namaDokter">{{ $pasien->dokter }}</span>
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
                    <input type="hidden" name="jenis"  value="{{ $antrian->jenis }}">
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
            <!-- Umum Tahap Dua -->
            <!-- Admedika Tahap Dua -->
            <div class="table-container-tahapdua">
                <h1 class="heading-pemeriksaan-pasien">Tindakan Gigi</h1>
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="container-tind-gigi">
                        <h2 class="namaPasienAdmedika">Jenis Tindakan</h2>
                        <div class="container-spanAdmedika">
                            <input type="text" class="soap" onchange="handleInput(this)">
                        </div>
                        <h2 class="namaPasienAdmedika">Biaya</h2>
                        <div class="spanGray">
                            <input type="number" class="namaDokter" id="hargaTindakan">
                        </div>
                    </div>
                </div>
                <h1 class="heading-pemeriksaan-pasien">SOAP</h1>
                <div class="border-pertabel"></div>
                <div class="container-soap">
                    <div class="child-soap">
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Subjective</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap" onchange="handleSubjektif(this)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Objective</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap" onchange="handleObjektif(this)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Assesment</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap" onchange="handleAssesment(this)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Plan</h2>
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
    //SOAP
    const pasienId = document.getElementById('pasienInput');
    const subjektifId = document.getElementById('subjektifInput');
    const objektifId = document.getElementById('objektifInput');
    const assesmentId = document.getElementById('assesmentInput');
    const planId = document.getElementById('planInput');
    const tindakanId = document.getElementById('tindakanInput');
    const biayaId = document.getElementById('biayaInput');
    const tanggalId = document.getElementById('tanggalInput');
    const noresepId = document.getElementById('noresepInput');


    let total = 0;
    let tindakan = [];
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

 
    document.getElementById('hargaTindakan').addEventListener("input", function (e) {
        if (e.target.value !== "") {
            biayaId.value = JSON.stringify([parseInt(e.target.value)]);
            console.log('harga: ', biayaId.value)
            // console.log('dataType: ', typeof biayaId.value)
        }else {
            biayaId.value = JSON.stringify([parseInt(0)]);
            console.log('harga: ', biayaId.value)
            // console.log('dataType: ', typeof biayaId.value)
        }
    })

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
   
    function handleInput(e) {
        tindakan.push(e.value)
        tindakanId.value = JSON.stringify(tindakan)
        // console.log(e.value)
        // console.log(tindakanId)
    }

    
</script>