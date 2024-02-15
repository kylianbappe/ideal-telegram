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
            <div class="table-container">
                <h1 class="heading-pemeriksaan-pasien">Tindakan Gigi</h1>
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="container-tind-gigi">
                        <h2 class="namaPasienAdmedika">Jenis Tindakan</h2>
                        <div class="parent-dd">
                            <div class="dropdown">
                                <span>Pilih</span>
                                <div class="iconfa">
                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="selectOption">
                                <div class="choice">
                                    <input type="checkbox" value="Tidak Ada" data-price="0" onchange="check(this, this)"/>
                                    <label for="">Tidak Ada</label>
                                </div>
                                <div class="choice">
                                    <input type="checkbox" value="Konsultasi" data-price="300000" onchange="check(this, this)"/>
                                    <label for="">Konsultasi - Rp. 300.000</label>
                                </div>
                                <div class="choice">
                                    <input type="checkbox" value="Pembersihan Karang Gigi" data-price="3000000" onchange="check(this, this)"/>
                                    <label for="">Pembersihan Karang Gigi - Rp. 3.000.000</label>
                                </div>
                                <div class="choice">
                                    <input type="checkbox" value="Bedah Abses" data-price="6000000" onchange="check(this, this)"/>
                                    <label for="">Bedah Abses - Rp. 6.000.000</label>
                                </div>
                            </div>
                        </div>
                        <h2 class="namaPasienAdmedika">Jumlah Harga</h2>
                        <div class="spanGray">
                            <input type="number" placeholder="Tulis (jika disc)" class="namaDokter">
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
                        <img src="{{ asset('/img/calendar.png') }}" class="cldnr"/>
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
                    <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $today = new DateTime('now');
                                $formattedDate = $today->format('d/m/Y');
                    ?>
                    <input type="hidden" name="tanggal" value="{{ $formattedDate }}" id="tanggalInput">
                    <div class="submitForm">
                        <button type="submit" class="submitAdmedika">DONE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

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
    function check(checkbox, e) {
        const price = parseFloat(e.getAttribute('data-price'));
        if (checkbox.checked) {
            total += price;
            tindakan.push(e.value)
            biayaId.value = total;
            tindakanId.value = JSON.stringify(tindakan);
            // console.log('value of biaya: ', biayaId.value)
            // console.log('value of tindakan: ', tindakanId.value)
            // console.log(total)
            // console.log(tindakan)
            // console.log("checked!")
        } else {
            tindakan = tindakan.filter((i) => i !== e.value)
            total -= price;
            biayaId.value = total;
            tindakanId.value = JSON.stringify(tindakan);
            // console.log('value of biaya: ', biayaId.value)
            // console.log('value of tindakan: ', tindakanId.value)
            // console.log('removed :', tindakan)
            // console.log('calculated :', total)
            // console.log("not checked!")
        }
    // console.log('now: ', total);
    // console.log('now: ', tindakan);
    }

    function handleSubjektif(e) {
        subjektifId.value = e.value;
        console.log('s: ', subjektifId.value)
    }
    function handleObjektif(e) {
        objektifId.value = e.value;
        console.log('o: ', objektifId.value)
    }
    function handleAssesment(e) {
        assesmentId.value = e.value;
        console.log('a: ', assesmentId.value)
    }
    function handlePlan(e) {
        planId.value = e.value;
        console.log('p: ', planId.value)
    }
   
    
    
</script>