<?php

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

$router->get("nasabah", "NasabahController@showAllNasabah");
$router->get("select-nasabah", "NasabahController@nasabahForSelect2");
$router->post("nasabah", "NasabahController@insertNasabah");

$router->get("transaksi", "TransaksiController@index");
$router->post("transaksi", "TransaksiController@store");

$router->get("cek-poin", "TransaksiController@show_point");

$router->post("cetak-tabungan", "TransaksiController@print_tabungan");