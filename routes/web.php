<?php

use App\Http\Controllers\NasabahController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

$router->get('/', function () {
    return view("list-nasabah");
});

$router->get('customer', function () {
    return view("list-nasabah");
});

$router->get('transaction', function () {
    return view("list-transaksi");
});

$router->get('tabungan', function () {
    return view("report-buku-tabungan");
});

$router->get('poin', function () {
    return view("show-point");
});

$router->get("nasabah", [NasabahController::class, "showAllNasabah"]);
$router->get("select-nasabah", [NasabahController::class, "nasabahForSelect2"]);
$router->post("nasabah", [NasabahController::class, "insertNasabah"]);

$router->get("transaksi", [TransaksiController::class, "index"]);
$router->post("transaksi", [TransaksiController::class, "store"]);

$router->get("cek-poin", [TransaksiController::class, "show_point"]);

$router->post("cetak-tabungan", [TransaksiController::class, "print_tabungan"]);

Route::get("json", [NasabahController::class, "json"])->name("nasabah.data");