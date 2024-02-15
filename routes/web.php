<?php

//Middleware
use App\Http\Middleware\Auths;
use Illuminate\Support\Facades\Route;

//Controller
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\Home;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Post Auth
Route::get("/login", [AuthUser::class, 'indexOfAuth'])->name('login');
Route::post('/login/proses', [AuthUser::class, 'login']);
Route::post('/login', [AuthUser::class, 'destroy'])->name('logout');


//Post SOAP
Route::post('/buat-soap', [Home::class, 'buatSoap']);

//Cari Laporan
Route::post('/carilaporan', [Home::class, 'cariLaporan']);

//Tambah Pasien
Route::post('/buatpasien', [Home::class, 'buatPasien']);

//Antrian Pasien
Route::post("/antrian", [Home::class, 'buatAntrian']);

//Hapus Pasien
Route::delete("/hapuspasien/{id}", [Home::class, 'deletePasien'])->name("hapusPasien");

//Hapus Antrian
Route::delete("/hapusantrian/{id}", [Home::class, 'hapusAntrian'])->name("hapusAntrian");

//Bayar Invoice
Route::post("/payment/{id}", [Home::class, 'paymentInvoice'])->name('bayarInvoice');

//Pembukuan
Route::post("/mencari-pembukuan", [Home::class, 'cariPembukuan']);

//Cari Invoice
Route::get("/detail-pembukuan/{id}/{nama}", [Home::class, 'riwayatInvoice'])->name('dapatkanInvoice');

//Reset Password
Route::post("/password-reset", [Home::class, 'passwordChange']);

//Invoice
Route::get("/invoice/{id}", [Home::class, 'invoiceHandler'])->name('invoice');


//Hapus Antrian Setelah Bayar
Route::delete("/paymentSuccessAndDone/{id}", [Home::class, 'deleteAntrianAfterPayment'])->name('deleteAntrianAfterPayment');

//Edit Pasien
Route::post("/editpasien/{id}", [Home::class, 'editPasienFunc'])->name('editPasienAksi');

//Routing Web Dokter
Route::middleware(['auth'])->group(function () {
Route::get("/", [Home::class, 'indexOfHome']);
Route::get("/pemeriksaan", [Home::class, 'pemeriksaanPasien']);
Route::get("/pemeriksaan/pasien-admedika/{id}/antrian/{antrianId}", [Home::class, 'pasienAdmedika'])->name('admedika-tahapsatu');
Route::get("/pemeriksaan/pasien-admedika/tindakan/{id}", [Home::class, 'pasienAdmedikaTahapDua'])->name('admedika-tahapdua');
Route::get("/pemeriksaan/pasien-umum/{id}/antrian/{antrianId}", [Home::class, 'pasienUmum'])->name('umum-tahapsatu');
Route::get("/pemeriksaan/pasien-umum/tindakan", [Home::class, 'pasienUmumTapaDua']);
Route::get("/resetpassword", [Home::class, 'resetPassword']);
Route::get("/informasiakun", [Home::class, 'accountInformation']);
Route::get("/riwayatpasien", [Home::class, 'riwayatPasien']);
Route::get("/detailriwayat/{id}", [Home::class, 'detailRiwayat'])->name('detailriwayat');
Route::get("/riwayat/belum-datang", [Home::class, 'namBulan']);
Route::get("/riwayat/belum-datang/{id}/{nama}", [Home::class, 'namBulanSoap'])->name('nambulanSoap');
Route::get("/laporan-pemeriksaan", [Home::class, 'laporanPemeriksaan']);
Route::get("/laporan-pemeriksaan/hasil", [Home::class, 'hasilLaporan']);
Route::get("/admin/dashboard", [Home::class, 'administrasiHome']);
Route::get("/pasien/buat", [Home::class, 'tambahPasien']);
Route::get("/daftarpasien", [Home::class, 'daftarPasien']);
Route::get("/daftarpasien/jenis/{id}", [Home::class, 'daftarPasienTahapDua'])->name('inputpasien');
Route::get("/daftarpasien/soap/{id}", [Home::class, 'daftarPasienTahapTiga'])->name('cekriwayatpasien');
Route::get("/antrianpasien", [Home::class, 'antrianPasien']);
Route::get("/pembayaran/{nama}/{idresep}", [Home::class, 'pembayaranPasien'])->name('checkout');
Route::get("/pembukuan-transaksi", [Home::class, 'pembukuanTransaksi']);
Route::get("/pembukuan/laporan", [Home::class, 'hasilPembukuan']);
Route::get("/pembukuan/detail/pasien", [Home::class, 'detailPembukuan']);
Route::get("/editpasien/{id}", [Home::class, 'editPasien'])->name("edit-pasien");
});