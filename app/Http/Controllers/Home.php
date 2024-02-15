<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use DateTime;

//MODELS
use App\Models\User;
use App\Models\Soap;
use App\Models\Resep;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Invoice;

class Home extends Controller
{
    function indexOfHome() {
        //Today State
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime('now');
        $today = $date->format('d/m/Y');

        //Monthly State
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        //Monthly Pasien
        $monthlyUniqueId = [];
        $totalPatients = DB::table('soap')
            ->where('dokter', Auth::user()->nama)
            ->whereRaw('DATE_FORMAT(STR_TO_DATE(tanggal, "%d/%m/%Y"), "%m/%Y") = ?', ["$currentMonth/$currentYear"])
            ->get();
        foreach($totalPatients as $monthlyPatient) {
            $monthlyUniqueId[] = $monthlyPatient->pasien;
        }

        $monthPasien = [];
            $fixedDuplicateMonthlyPasien = array_unique($monthlyUniqueId);
            foreach($fixedDuplicateMonthlyPasien as $monthlyName) {
                $monthlyPasienSudahDiTangani = DB::table('pasien')->where('nama', $monthlyName)->first();
                $monthPasien[] = $monthlyPasienSudahDiTangani;
            }
    

            //Daily Pasien
            $soap = DB::table('soap')
                        ->where('dokter', Auth::user()->nama)
                        ->where('tanggal', $today)
                        ->get();

            $uniqueId = [];
            foreach($soap as $dataSoap) {
                $uniqueId[] = $dataSoap->pasien;
            }

            $todayPasien = [];
            $fixedDuplicatePasien = array_unique($uniqueId);
            foreach($fixedDuplicatePasien as $name) {
                $todayPasienSudahDiTangani = DB::table('pasien')->where('nama', $name)->first();
                $todayPasien[] = $todayPasienSudahDiTangani;
            }

            // dd($todayPasien, $monthPasien);
        return view('HomePage', ['soapRecords' => $todayPasien, 'totalPasienPerBulan' => $monthPasien]);
    }

    function pemeriksaanPasien() {
        try{
            $pasien = DB::table('antrian')->where('dokter', Auth::user()->nama)->get();
            if ($pasien->isEmpty()) {
                $message = "Belum ada pasien!";
            }
            $pasienWithData = [];
            foreach ($pasien as $antrian) {
                $eachPasien = DB::table('pasien')->where('nama', $antrian->nama)->first();
                $antrian->lahir = $eachPasien->lahir;
                $antrian->pasienId = $eachPasien->id;
                
                if ($antrian->selesai == false) {
                    $pasienWithData[] = $antrian;
                } else {

                }
                // if ($antrian->selesai == true) {
                //     $message = "Tidak ada pasien!";
                // } else {
                //     $message = "Ada pasien!";
                // }
            }

            // dd($message);   
            // dd($pasienWithData);
            return view("PemeriksaanPasien", ['pasiens' => $pasienWithData]);
        }catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    function pasienAdmedika($id, $antrianId) {
        // dd($antrianId);
        $antrian = DB::table('antrian')->where('id', $antrianId)->first();
        $pasien = DB::table('pasien')->where('id', $id)->first();
        return view("AdmedikaPertama", ['pasien' => $pasien, 'antrianId' => $antrianId, 'antrian' => $antrian]);
    }

    function pasienAdmedikaTahapDua($id) {
        $pasien = DB::table('pasien')->where('id', $id)->first();
        return view("AdmedikaKedua", ['pasien' => $pasien]);
    }

    function pasienUmum($id, $antrianId) {
        $antrian = DB::table('antrian')->where('id', $antrianId)->first();
        $pasien = DB::table('pasien')->where('id', $id)->first();
        // dd($pasien->jenis !== "Pasien Umum");
        return view("UmumPertama", ['pasien' => $pasien, 'antrianId' => $antrianId, 'antrian' => $antrian]);
    }

    function pasienUmumTapaDua() {
        return view("UmumKedua");
    }

    function passwordChange(Request $request) {
        $request->validate([
            'nama'=> 'required',
            'passwordlama'=> 'required',
            'passwordbaru'=> 'required',
            'konfirmasipassword'=> 'required',
        ], [
            'nama'=> 'Username wajib diisi',
            'passwordlama'=> 'Password lama wajib diisi',
            'passwordbaru'=> 'Password baru wajib diisi',
            'konfirmasipassword'=> 'Konfirmasi password wajib diisi',
        ]);


        if($request->nama != auth()->user()->nama) {
            return back()->withError('Username salah');
        }

        if(!Hash::check($request->passwordlama, auth()->user()->password)) {
            return back()->withError('Password lama salah!');
        }

        if ($request->passwordbaru != $request->konfirmasipassword) {
            return back()->withError('Password lama dan konfirmasi password tidak sama!');
        }

        auth()->user()->update([
            'password' => Hash::make($request->passwordbaru)
        ]);

        return back()->with('status', 'Password berhasil diganti!');
    }

    function resetPassword() {
        return view("ResetPassword");
    }

    function accountInformation() {
        return view("InformasiAkun");
    }

    function riwayatPasien() {
        $soap = DB::table('soap')->where('dokter', Auth::user()->nama)->get();

        $data = [];
        $uniqueId = [];
        foreach ($soap as $eachSoap) {
            $pasienTable = DB::table('pasien')->where('nama', $eachSoap->pasien)->first();
            if (!$pasienTable) {
                $message = "Tidak ada data yang cocok!";
            } else {
                $uniqueId[] = $pasienTable->id;
            }
        }
        $filteredUniquePasien = array_unique($uniqueId);
        foreach ($filteredUniquePasien as $id) {
            $findPasien = DB::table('pasien')->where('id', $id)->first();
            $data[] = $findPasien;
        }
        
        // dd($data);
        return view("RiwayatPasien", ['pasiens' => $data]);
    }

    function detailRiwayat($id) {
        $pasien = DB::table('pasien')->where('id', $id)->first();
        $soap = DB::table('soap')->where('pasien', $pasien->nama)
        ->where('dokter', Auth::user()->nama)
        ->get();
        return view("DetailRiwayat", ['pasien' => $pasien, 'soap' => $soap]);
    }
 
    function namBulan() {
        $today = date('d/m/Y');
        $pasien = DB::table('soap')->where('dokter', Auth::user()->nama)->get();
        $filteredPatients = [];
        
        foreach ($pasien as $patient) {
            // Fetch SOAP records for the patient, ordered by date in descending order
            $soapRecords = DB::table('soap')
                ->where('pasien', $patient->pasien)
                ->where('reminder', true)
                ->orderBy('tanggal', 'desc')
                ->get();
        
            // Variable to store the newest SOAP record that meets the expiration criteria
            $newestExpiredSoapRecord = null;
        
            foreach ($soapRecords as $soap) {
                // Extract the date of the SOAP record
                $soapDate = Carbon::createFromFormat('d/m/Y', $soap->tanggal);
        
                // Calculate the date six months ago
                $sixMonthsAgo = Carbon::now()->subMonths(6);
        
                // Check if the SOAP record is older than six months
                if ($soapDate->lte($sixMonthsAgo)) {
                    // Update $newestExpiredSoapRecord if this SOAP record is newer than the current one
                    if ($newestExpiredSoapRecord === null || $soapDate->gt(Carbon::createFromFormat('d/m/Y', $newestExpiredSoapRecord->tanggal))) {
                        $newestExpiredSoapRecord = $soap;
                    }
                }
            }

            
            // If a SOAP record meeting the expiration criteria was found, add it to $filteredPatients
            if ($newestExpiredSoapRecord !== null) {
                $getPasienData = DB::table('pasien')->where('nama', $patient->pasien)->first();
                $filteredPatients[$patient->pasien] = [
                    'patientInfo' => $getPasienData,
                    'newestSoapRecord' => $newestExpiredSoapRecord
                ];
            }
        }
        // dd($filteredPatients);

        return view("DaftarEnamBulan", ['pasien' => $filteredPatients]);
    }

    function namBulanSoap($id, $nama) {
        $pasien = DB::table('pasien')->where('nama', $nama)->first();
        $soap = DB::table('soap')->where('id', $id)->first();

        return view("DaftarEnamBulanSoap", ['soap' => $soap, 'pasien' => $pasien]);
    }

    function laporanPemeriksaan() {
        return view("LaporanPemeriksaan");
    }


    function cariLaporan(Request $request) {
        $bulanNames = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        
        $selectedMonth = $request->input('bulan');
        $selectedYear = $request->input('tahun');
        $selectedType = $request->input('jenis');

        $bulanName = $bulanNames[$selectedMonth];
        
        $selectedDate = $selectedMonth . '/' . $selectedYear;

        $patients = DB::table('pasien')->get();
        $allPasien = [];
        if ($selectedType == "Semua") {
            foreach ($patients as $patient) {
                    $newestSoapRecord = DB::table('soap')
                        ->where('dokter', Auth::user()->nama)
                        ->whereRaw("MONTH(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedMonth)])
                        ->whereRaw("YEAR(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedYear)])
                        ->orderBy('tanggal', 'desc')
                        ->get();
    
                        foreach($newestSoapRecord as $soapRecord) {
                            if ($soapRecord->pasien == $patient->nama) {
                                $soapRecord->nkp = $patient->nkp;
                                $allPasien[] = $soapRecord;
                            } else {
                                
                            }
                        }
            }
        } else {
                foreach ($patients as $patient) {
                    $newestSoapRecord = DB::table('soap')
                    ->where('dokter', Auth::user()->nama)
                    ->where("jenis_pasien", $selectedType)
                    ->whereRaw("MONTH(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedMonth)])
                    ->whereRaw("YEAR(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedYear)])
                    ->orderBy('tanggal', 'desc')
                    ->get();

                    foreach($newestSoapRecord as $soapRecord) {
                        if ($soapRecord->pasien == $patient->nama) {
                            $soapRecord->nkp = $patient->nkp;
                            $allPasien[] = $soapRecord;
                        } else {
                            
                        }
                    }
                }
        }
        // dd($allPasien);
        return view("HasilLaporan", ['pasien' => $allPasien, 'bulan' => $bulanName, 'tahun' => $selectedYear]);
    }

    function hasilLaporan() {
        
        return view("HasilLaporan");
    }
   
    function administrasiHome() {
        $today = Carbon::now()->format('d/m/Y');

        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $jumlahPasienBulanIni = DB::table('pasien')
            ->whereRaw("MONTH(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [$currentMonth])
            ->whereRaw("YEAR(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [$currentYear])
            ->count();

        $jumlahPasienHariIni = DB::table('pasien')
            ->where('tanggal', $today)
            ->count();

        // dd($jumlahPasienHariIni, $jumlahPasienBulanIni);

        return view("AdministrasiHome", [
            'jumlahPasienBulanIni' => $jumlahPasienBulanIni,
            'jumlahPasienHariIni' => $jumlahPasienHariIni,
        ]);
    }

    function buatPasien(Request $request) {
        $today = Carbon::now()->format('d/m/Y');
        $buat = new Pasien;
        $buat->nama = $request->input('nama');
        $buat->kelamin = $request->input('kelamin');
        $buat->lahir = $request->input('lahir');
        $buat->alamat = $request->input('alamat');
        $buat->nik = $request->input('nik');
        $buat->telpon = $request->input('telpon');
        $buat->nkp = $request->input('nkp');
        $buat->tanggal = $today;

        try{
            $buat->save();
            return redirect('/daftarpasien')->with('success', 'Berhasil membuat pasien baru!');
        }catch (Exception $e) {
            return response()->json(['message' => 'gagal membuat pasien baru!', 500]);
        }
    }

    function tambahPasien() {
        return view("TambahPasien");
    }

    function daftarPasien() {
        $daftarPasien = DB::table('pasien')->get();
        return view("DaftarPasien", ['daftarPasien' => $daftarPasien]);
    }

    function daftarPasienTahapDua($id) {
        $dokter = DB::table('users')->where('isAdmin', 0)->get();
        $pasien = DB::table('pasien')->where('id', $id)->first();

        // dd($dokter);
        return view("DaftarPasienDua", ['dokter' => $dokter, 'pasien' => $pasien]);
    }

    function buatAntrian(Request $request) {
        $id = $request->input('id');
        $updatePasien = Pasien::find($id);

        $antrian = new Antrian;
        $antrian->nkp = $updatePasien->nkp;
        $antrian->nama = $updatePasien->nama;
        $antrian->dokter = $request->dokter;
        $antrian->jenis = $request->input('jenis');
        $antrian->save();
        try{
            if ($updatePasien) {
                //Handle Update
                $updatePasien->jenis = $request->input('jenis');
                $updatePasien->dokter = $request->input('dokter');
                $updatePasien->save();
                return redirect("/antrianpasien")->with("Berhasil memperbarui data pasien!");
            } else {
                return redirect("/daftarpasien/jenis/$id")->withError("Kesalahan terjadi, pasien tidak ditemukan!");
            }
        }catch (Exception $e) {
            return dd($e);
        }


    }

    function editPasien($id) {
        $pasien = DB::table('pasien')->where('id', $id)->first();
        return view("EditPasien", ['pasien' => $pasien]);
    }

    function editPasienFunc(Request $request, $id) {
        $pasien = Pasien::findOrFail($id);

        if ($request->filled('nama')) {
            $pasien->nama = $request->input('nama');
        }
        if ($request->filled('kelamin')) {
            $pasien->kelamin = $request->input('kelamin');
        }
        if ($request->filled('lahir')) {
            $pasien->lahir = $request->input('lahir');
        }
        if ($request->filled('alamat')) {
            $pasien->alamat = $request->input('alamat');
        }
        if ($request->filled('nik')) {
            $pasien->nik = $request->input('nik');
        }
        if ($request->filled('nkp')) {
            $pasien->nkp = $request->input('nkp');
        }
        if ($request->filled('telpon')) {
            $pasien->telpon = $request->input('telpon');
        }

        $pasien->save();

        return back()->with('status', "Berhasil memperbarui data pasien!");
    }

    function deletePasien($id) {
        try{
            $hapusPasien = Pasien::findOrFail($id);
            $hapusPasien->delete();
            return redirect("/daftarpasien")->with("Berhasil menghapus pasien dari list!");
        }catch (Exception $e) {
            return dd($e)->getMessage("Kesalahan terjadi!");
        }
    }
    
    function hapusAntrian($id) {
        // dd($id);
        try{
            $hapusAntrian = Antrian::where('id', $id)->delete();
            return redirect("/antrianpasien")->with("Berhasil menghapus antrian dari list!");
        }catch (Exception $e) {
            return dd($e)->getMessage("Kesalahan terjadi!");
        }
    }

    function daftarPasienTahapTiga($id) {
        $dataPasien = DB::table('pasien')->where('id', $id)->first();
        $rawSoap = DB::table('soap')->where('pasien', $dataPasien->nama)->get();
        $totalSoap = [];
        if ($rawSoap->isEmpty()) {
            $dataSoap = "Belum memiliki riwayat";
        }
        foreach ($rawSoap as $soap) {
            if ($dataPasien->nama == $soap->pasien) {
                $dataSoap = $soap;
                $totalSoap[] = $soap;
            }else {
            }
        }

        // dd($totalSoap);
        // dd($dataSoap);
        // dd($rawSoap);
        return view("DaftarPasienTiga", ['datapasien' => $dataPasien, 'datasoap' => $dataSoap, 'totalSoap' => $totalSoap]);
    }

    function antrianPasien() {
        $cariPasien = DB::table('antrian')->get();
        $antrianPasien = DB::table('antrian')->get();
        $pasienSudahPunyaDokter = [];

        foreach ($antrianPasien as $pasien) {
            if ($pasien->dokter !== null ) {
                $pasienSudahPunyaDokter[] = $pasien;
            } else {
                
            }
        } 
        // dd($pasienSudahPunyaDokter);

        return view("AntrianPasien", ['pasienBerdokter' => $pasienSudahPunyaDokter]);
    }

    function pembayaranPasien($nama, $idresep) {
        $cariPasienSesuaiNoResep = DB::table('soap')->where('noresep', $idresep)->first();
        $pasien = DB::table('pasien')->where('nama', $cariPasienSesuaiNoResep->pasien)->first();

        if (empty($cariPasienSesuaiNoResep->invoice_id) || $cariPasienSesuaiNoResep->invoice_id == null) {
            // dd("Metode doesn't have value!");
            $metodePembayaran = 0;
        } else {
            // dd("Metode has value!");
            $metodePembayaran = DB::table('invoice')->where('id_invoice', $cariPasienSesuaiNoResep->invoice_id)->first();
        }

        return view("PembayaranPasien", ['jenisPasien' => $pasien, 'totalHargaSoap' => $cariPasienSesuaiNoResep, 'metodePembayaran' => $metodePembayaran]);


        // $totalCheckout = DB::table('soap')->where('pasien', $nama)->get();
        // $jenisPasien = DB::table('pasien')->where('nama', $nama)->first();

        // $soapRecord = [];
        // if (!$totalCheckout) {
        //     $totalCheckout = 'Tidak ada riwayat konsultasi!';
        // } else {
        //     foreach ($totalCheckout as $total) {
        //         array_push($soapRecord, $total->id);
        //         $finalRecord = max($soapRecord);
        //         $highestTotalPrice = DB::table('soap')->where('id', $finalRecord)->first();
        //         $invoiceId = $highestTotalPrice->invoice_id;
        //     } 
        // }

        // if (!isset($highestTotalPrice)) {
        //     $highestTotalPrice = 'Tidak ada riwayat konsultasi!';
        // } else if ($highestTotalPrice->status_pembayaran == true) {
        //     $highestTotalPrice = 'Tidak ada tagihan!';
        // } else {
            
        // }
        // // if ($highestTotalPrice->status_pembayaran == true) {
        // //     $highestTotalPrice = 'Tidak ada tagihan!';
        // // } else {
            
        // // }

        // // dd($invoiceId, $highestTotalPrice, $jenisPasien);
        // // dd($finalRecord);
        // // dd($soapRecord);
        // // dd($totalCheckout);
        // // dd($jenisPasien);
    }


    function deleteAntrianAfterPayment($id) {
        $antrian = DB::table('antrian')->where('noresep', $id);
        $antrian->delete();
        return redirect("/antrianpasien")->with("Berhasil melakukan transaksi!");
    }


    function paymentInvoice(Request $request, $id) {
        $cariSoapHarusDibayar = Soap::findOrFail($id);
        $today = Carbon::now()->format('d/m/Y');
        $randomInvoiceId = '';
        for ($i = 0; $i < 5; $i++) {
            $randomInvoiceId .= rand(0, 9); // Append a random digit (0-9) to the invoice ID
        }

        try{
            $buatInvoice = new Invoice;
            $buatInvoice->id_invoice = $randomInvoiceId;
            $buatInvoice->admin = $request->input('nama-admin');
            $buatInvoice->pasien = $cariSoapHarusDibayar->pasien;
            $buatInvoice->jenis_pasien = $cariSoapHarusDibayar->jenis_pasien;
            $buatInvoice->tindakan = $cariSoapHarusDibayar->tindakan;
            $buatInvoice->dokter = $cariSoapHarusDibayar->dokter;
            $buatInvoice->modepembayaran = $request->input('metode');
            $buatInvoice->totalharga = $request->input('harga');
            $buatInvoice->tanggal = $today;
            
            $cariSoapHarusDibayar->status_pembayaran = true;
            $cariSoapHarusDibayar->invoice_id = $randomInvoiceId;

            if (empty($request->input('metode'))) {
                return redirect("/pembayaran/$cariSoapHarusDibayar->pasien/$cariSoapHarusDibayar->noresep",)->withError("Harap pilih metode pembayaran sebelum bayar!");
            }


            $cariSoapHarusDibayar->save();
            $buatInvoice->save();


            // dd($buatInvoice, $cariSoapHarusDibayar);
            return back()->with("Berhasil melakukan pembayaran!");
        }catch (Exception $e) {
            return redirect("/pembayaran/$cariSoapHarusDibayar->pasien")->withError($e);
        }
      
        // dd($cariSoapHarusDibayar, $metodePembayaran, $namaAdmin, $harga);
    }

    function pembukuanTransaksi(Request $request) {
        return view("PembukuanTransaksi");
    }

    function cariPembukuan(Request $request) {
        $bulanNames = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $selectedMonth = $request->input('bulan');
        $bulanName = $bulanNames[$selectedMonth];
        $selectedYear = $request->input('tahun');
        $newestSoapRecords = DB::table('soap')
                ->where('status_pembayaran', 1)
                ->whereRaw("MONTH(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedMonth)])
                ->whereRaw("YEAR(STR_TO_DATE(tanggal, '%d/%m/%Y')) = ?", [intval($selectedYear)])
                ->orderBy('tanggal', 'desc')
                ->get();

        foreach ($newestSoapRecords as $pembukuan) {
            $dataPasien = DB::table('pasien')->where('nama', $pembukuan->pasien)->first();
            // dd($dataPasien);
            $pembukuan->nkp = $dataPasien->nkp;
        }

        // dd($newestSoapRecords);

            // // Initialize an empty array to store the combined data
            // $dataPembukuan = [];

            // // Iterate through each soap record
            // foreach ($newestSoapRecords as $soapRecord) {
            //     // Find the corresponding patient data
            //     $patientData = DB::table('pasien')
            //         ->where('nama', $soapRecord->pasien)
            //         ->first();

            //     // If patient data is found, add it to the combined data array
            //     if ($patientData) {
            //         $dataPembukuan[] = [
            //             'soapRecord' => $soapRecord,
            //             'patientData' => $patientData,
            //         ];
            //     }
            // }
            // dd($dataPembukuan);
        return view("HasilPembukuan", ['dataPembukuan' => $newestSoapRecords, 'bulan' => $bulanName, 'tahun' => $selectedYear]);
    }


    function hasilPembukuan() {
        return view("HasilPembukuan");
    }
    
    function riwayatInvoice($id, $nama) {
        $soapWithInvoiceId = DB::table('invoice')->where('id_invoice', $id)->first();
        $handlePatient = DB::table('pasien')->where('nama', $nama)->first();

        if (!$soapWithInvoiceId) {
            //handle data not found!
            // dd(@$handlePatient);
            $soapWithInvoiceId = null;
            $nkp = null;
        } else {
            $patient = DB::table('pasien')->where('nama', $soapWithInvoiceId->pasien)->first();
            $nkp = $patient->nkp;
        }
        
        // dd($nkp);
        return view("DetailPembukuan", ['data' => $soapWithInvoiceId, 'nkp' => $nkp, 'handlePatient' => $handlePatient]);
    }


    // CRUD
    function buatSoap(Request $request) {
        $antrianSelesai = Antrian::findOrFail($request->input('antrian-id'));
        $antrianSelesai->selesai = true;
        $antrianSelesai->save();


        $resepAntrian = Antrian::findOrFail($request->input('antrian-id'));
        $resepTerakhir = Resep::first();
        $resepBaru = $resepTerakhir->noresep + 1;


        $resepTerakhir->noresep = $resepBaru;

        $resepAntrian->noresep = $resepBaru;

        $resepAntrian->save();
        $resepTerakhir->save();

        $soap = new Soap;
        $soap->pasien = $request->input('pasien');
        $soap->dokter = Auth::user()->nama;
        $soap->subjektif = $request->input('subjektif');
        $soap->objektif = $request->input('objektif');
        $soap->assesment = $request->input('assesment');
        $soap->plan = $request->input('plan');
        $soap->tindakan = $request->input('tindakan');
        $soap->biaya = $request->input('biaya');
        $soap->tanggal = $request->input('tanggal');
        $soap->reminder = $request->input('reminder');
        $soap->jenis_pasien = $request->input('jenis');
        $soap->noresep = $resepBaru;
        $soap->status_pembayaran = false;

        try{
            $soap->save();
            return redirect('/pemeriksaan')->with('success', 'Your action was successful!');
        }catch (Exception $e) {
            return response()->json(['message' => 'gagal membuat soap!', 500]);
        }
    }



    function invoiceHandler($id) {
        $invoice = DB::table('invoice')->where('id_invoice', $id)->first();
        return view("Invoice", ['invoice' => $invoice]);
    }

}
