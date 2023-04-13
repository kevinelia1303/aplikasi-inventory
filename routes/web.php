<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;

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

Route::get('/', function () {
    return view('layout.v_template');
});

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/update/{id_user}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);


Route::get('/finished-goods', [BarangController::class, 'indexfg']);
Route::get('/finished-goods/detailfg/{id_barang}', [BarangController::class, 'detailfg']);
Route::get('/finished-goods/addfg', [BarangController::class, 'addfg']);
Route::post('/finished-goods/insertfg', [BarangController::class, 'insertfg']);
Route::get('/finished-goods/editfg/{id_barang}', [BarangController::class, 'editfg']);
Route::post('/finished-goods/updatefg/{id_barang}', [BarangController::class, 'updatefg']);
Route::get('/finished-goods/deletefg/{id_barang}', [BarangController::class, 'deletefg']);


Route::get('/greige', [BarangController::class, 'indexgreige']);
Route::get('/greige/detailgreige/{id_barang}', [BarangController::class, 'detailgreige']);
Route::get('/greige/addgreige', [BarangController::class, 'addgreige']);
Route::post('/greige/insertgreige', [BarangController::class, 'insertgreige']);
Route::get('/greige/editgreige/{id_barang}', [BarangController::class, 'editgreige']);
Route::post('/greige/updategreige/{id_barang}', [BarangController::class, 'updategreige']);
Route::get('/greige/deletegreige/{id_barang}', [BarangController::class, 'deletegreige']);



Route::get('/benang', [BarangController::class, 'indexbenang']);
Route::get('/benang/detailbenang/{id_barang}', [BarangController::class, 'detailbenang']);
Route::get('/benang/addbenang', [BarangController::class, 'addbenang']);
Route::post('/benang/insertbenang', [BarangController::class, 'insertbenang']);
Route::get('/benang/editbenang/{id_barang}', [BarangController::class, 'editbenang']);
Route::post('/benang/updatebenang/{id_barang}', [BarangController::class, 'updatebenang']);
Route::get('/benang/deletebenang/{id_barang}', [BarangController::class, 'deletebenang']);


Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/supplier/add', [SupplierController::class, 'add']);
Route::post('/supplier/insert', [SupplierController::class, 'insert']);
Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit']);
Route::post('/supplier/update/{id}', [SupplierController::class, 'update']);
Route::get('/supplier/delete/{id}', [SupplierController::class, 'delete']);


Route::get('/gudang', [GudangController::class, 'index']);
Route::get('/gudang/add', [GudangController::class, 'add']);
Route::post('/gudang/insert', [GudangController::class, 'insert']);
Route::get('/gudang/edit/{kode_gudang}', [GudangController::class, 'edit']);
Route::post('/gudang/update/{kode_gudang}', [GudangController::class, 'update']);
Route::get('/gudang/delete/{kode_gudang}', [GudangController::class, 'delete']);


Route::view('/maklondf', 'Purchase Order.v_po_maklondf');
Route::view('/maklontwisting', 'Purchase Order.v_po_maklontwisting');
Route::view('/pogreige', 'Purchase Order.v_po_greige');


Route::get('/pobenang', [PurchaseOrderController::class, 'indexpobenang']);
Route::get('/pobenang/add', [PurchaseOrderController::class, 'addpobenang']);
Route::post('/pobenang/insert', [PurchaseOrderController::class, 'simpan']);
Route::post('/submitData', [PurchaseOrderController::class, 'submitData'])->name('submitData');
Route::get('/pobenang/edit/{id}', [PurchaseOrderController::class, 'editpobenang']);
Route::post('/pobenang/update/{id}', [PurchaseOrderController::class, 'updatepobenang']);
Route::get('/pobenang/detailpobenang/{id}', [PurchaseOrderController::class, 'detailpobenang']);


Route::view('/gipenjualan', 'Goods Issue.v_gi_penjualan');
Route::view('/gitwisting', 'Goods Issue.v_gi_twisting');
Route::view('/gidyeingfinishing', 'Goods Issue.v_gi_dyeingfinishing');

Route::view('/grpobenang', 'Goods Receipt.v_gr_benang');
Route::view('/grpogreige', 'Goods Receipt.v_gr_greige');
Route::view('/grtwisting', 'Goods Receipt.v_gr_twisting');
Route::view('/grdyeingfinishing', 'Goods Receipt.v_gr_dyeingfinishing');

Route::view('/stockfg', 'stock information.v_stockfg');
Route::view('/stockgreige', 'stock information.v_stockgreige');
Route::view('/stockbenang', 'stock information.v_stockbenang');