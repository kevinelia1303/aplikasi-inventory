<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\TransaksiGudangController;

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


Route::get('/pomaklondf', [PurchaseOrderController::class, 'indexpodf']);
Route::get('/pomaklondf/add', [PurchaseOrderController::class, 'addpodf']);
Route::post('/submitData3', [PurchaseOrderController::class, 'DFsubmitData'])->name('submitData3');
Route::get('/pomaklondf/edit/{id}', [PurchaseOrderController::class, 'editpodf']);
Route::post('/pomaklondf/update/{id}', [PurchaseOrderController::class, 'updatepodf']);
Route::get('/pomaklondf/detailpodf/{id}', [PurchaseOrderController::class, 'detailpodf']);


Route::get('/pomaklontwisting', [PurchaseOrderController::class, 'indexpotwisting']);
Route::get('/pomaklontwisting/add', [PurchaseOrderController::class, 'addpotwisting']);
Route::post('/submitData2', [PurchaseOrderController::class, 'TwistingsubmitData'])->name('submitData2');
Route::get('/pomaklontwisting/edit/{id}', [PurchaseOrderController::class, 'editpotwisting']);
Route::post('/pomaklontwisting/update/{id}', [PurchaseOrderController::class, 'updatepotwisting']);
Route::get('/pomaklontwisting/detailpotwisting/{id}', [PurchaseOrderController::class, 'detailpotwisting']);


Route::get('/pogreige', [PurchaseOrderController::class, 'indexpogreige']);
Route::get('/pogreige/add', [PurchaseOrderController::class, 'addpogreige']);
Route::post('/submitData1', [PurchaseOrderController::class, 'GreigesubmitData'])->name('submitData1');
Route::get('/pogreige/edit/{id}', [PurchaseOrderController::class, 'editpogreige']);
Route::post('/pogreige/update/{id}', [PurchaseOrderController::class, 'updatepogreige']);
Route::get('/pogreige/detailpogreige/{id}', [PurchaseOrderController::class, 'detailpogreige']);


Route::get('/pobenang', [PurchaseOrderController::class, 'indexpobenang']);
Route::get('/pobenang/add', [PurchaseOrderController::class, 'addpobenang']);
Route::post('/submitData', [PurchaseOrderController::class, 'BenangsubmitData'])->name('submitData');
Route::get('/pobenang/edit/{id}', [PurchaseOrderController::class, 'editpo']);
Route::post('/pobenang/update/{id}', [PurchaseOrderController::class, 'updatepo']);
Route::get('/pobenang/detailpobenang/{id}', [PurchaseOrderController::class, 'detailpobenang']);


Route::view('/gipenjualan', 'Goods Issue.v_gi_penjualan');


Route::get('/gitwisting', [TransaksiGudangController::class, 'indexgitwisting']);
Route::get('/gitwisting/add', [TransaksiGudangController::class, 'addgitwisting']);
Route::post('/submitData6', [TransaksiGudangController::class, 'GiTwistingsubmitData'])->name('submitData6');
Route::get('/gitwisting/detailgitwisting/{id}', [TransaksiGudangController::class, 'detailgitwisting']);
Route::get('/gitwisting/ajax', [TransaksiGudangController::class, 'ajax']);
Route::get('/gitwisting/ajax1', [TransaksiGudangController::class, 'ajax1']);

Route::view('/gidyeingfinishing', 'Goods Issue.v_gi_dyeingfinishing');


Route::get('/grpobenang', [TransaksiGudangController::class, 'indexgrbenang']);
Route::get('/grpobenang/add', [TransaksiGudangController::class, 'addgrbenang']);
Route::post('/submitData4', [TransaksiGudangController::class, 'GrBenangsubmitData'])->name('submitData4');
Route::get('/grpobenang/detailgrbenang/{id}', [TransaksiGudangController::class, 'detailgrbenang']);


Route::get('/grpogreige', [TransaksiGudangController::class, 'indexgrgreige']);
Route::get('/grpogreige/add', [TransaksiGudangController::class, 'addgrgreige']);
Route::post('/submitData5', [TransaksiGudangController::class, 'GrGreigesubmitData'])->name('submitData5');
Route::get('/grpogreige/detailgrgreige/{id}', [TransaksiGudangController::class, 'detailgrgreige']);


Route::view('/grtwisting', 'Goods Receipt.v_gr_twisting');
Route::view('/grdyeingfinishing', 'Goods Receipt.v_gr_dyeingfinishing');

Route::view('/stockfg', 'stock information.v_stockfg');
Route::view('/stockgreige', 'stock information.v_stockgreige');
Route::view('/stockbenang', 'stock information.v_stockbenang');