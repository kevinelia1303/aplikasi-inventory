<?php

use App\Http\Middleware\KepalaGudang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\StockOpnameController;
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

// Route::get('/', function () {
//     return view('layout.v_template');
// });
Route::get('/', [HomeController::class, 'index']);




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




Route::get('/stockfg', [StokController::class, 'stokfg']);
Route::get('/stockgreige', [StokController::class, 'stokgreige']);
Route::get('/stockbenang', [StokController::class, 'stokbenang']);
Auth::routes();



Route::group(['middleware' => 'User'], function (){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/add', [UserController::class, 'add']);
    Route::post('/user/insert', [UserController::class, 'insert']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update/{id_user}', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
});



Route::group(['middleware' => 'Inventory'], function (){
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


    Route::get('/gipenjualan', [TransaksiGudangController::class, 'indexgipenjualan']);
    Route::get('/gipenjualan/add', [TransaksiGudangController::class, 'addgipenjualan']);
    Route::post('/submitDataPenjualan', [TransaksiGudangController::class, 'GiPenjualansubmitData'])->name('submitDataPenjualan');
    Route::get('/gipenjualan/detailgipenjualan/{id}', [TransaksiGudangController::class, 'detailgipenjualan']);
    Route::get('/gipenjualan/ajax4', [TransaksiGudangController::class, 'ajax4']);
    Route::get('/gipenjualan/ajax5', [TransaksiGudangController::class, 'ajax5']);
    Route::get('/gipenjualan/printsj/{id}', [TransaksiGudangController::class, 'printsj']);
    Route::get('/gipenjualan/printpl/{id}', [TransaksiGudangController::class, 'printpl']);
    Route::get('/gipenjualan/edit/{id}', [TransaksiGudangController::class, 'editgipenjualan']);
    Route::post('/gipenjualan/update/{id}', [TransaksiGudangController::class, 'updategipenjualan']);



    Route::get('/gitwisting', [TransaksiGudangController::class, 'indexgitwisting']);
    Route::get('/gitwisting/add/{id}', [TransaksiGudangController::class, 'addgitwisting']);
    Route::post('/submitData6', [TransaksiGudangController::class, 'GiTwistingsubmitData'])->name('submitData6');
    Route::get('/gitwisting/detailgitwisting/{id}', [TransaksiGudangController::class, 'detailgitwisting']);
    Route::get('/gitwisting/ajax', [TransaksiGudangController::class, 'ajax']);
    Route::get('/gitwisting/ajax1', [TransaksiGudangController::class, 'ajax1']);
    Route::get('/gitwisting/printsj/{id}', [TransaksiGudangController::class, 'printsjtw']);
    Route::get('/gitwisting/printpl/{id}', [TransaksiGudangController::class, 'printpltw']);
    Route::get('/gitwisting/edit/{id}', [TransaksiGudangController::class, 'editgitwisting']);
    Route::post('/gitwisting/update/{id}', [TransaksiGudangController::class, 'updategitwisting']);


    Route::get('/gidf', [TransaksiGudangController::class, 'indexgidf']);
    Route::get('/gidf/add/{id}', [TransaksiGudangController::class, 'addgidf']);
    Route::post('/submitData8', [TransaksiGudangController::class, 'GiDFsubmitData'])->name('submitData8');
    Route::get('/gidf/detailgidf/{id}', [TransaksiGudangController::class, 'detailgidf']);
    Route::get('/gidf/ajax2', [TransaksiGudangController::class, 'ajax2']);
    Route::get('/gidf/ajax3', [TransaksiGudangController::class, 'ajax3']);
    Route::get('/gidf/printsj/{id}', [TransaksiGudangController::class, 'printsjdf']);
    Route::get('/gidf/printpl/{id}', [TransaksiGudangController::class, 'printpldf']);
    Route::get('/gidf/edit/{id}', [TransaksiGudangController::class, 'editgidf']);
    Route::post('/gidf/update/{id}', [TransaksiGudangController::class, 'updategidf']);

    Route::get('/ajax-lokasi', [TransaksiGudangController::class, 'ajaxlokasi']);
    Route::get('/ajax-tanggal', [TransaksiGudangController::class, 'ajaxtanggal']);
    Route::get('/ajax-keterangan', [TransaksiGudangController::class, 'ajaxketerangan']);

    Route::get('/grpobenang', [TransaksiGudangController::class, 'indexgrbenang']);
    Route::get('/grpobenang/add', [TransaksiGudangController::class, 'addgrbenang1']);
    Route::get('/grpobenang/add/{id}', [TransaksiGudangController::class, 'addgrbenang']);
    Route::post('/submitData4', [TransaksiGudangController::class, 'GrBenangsubmitData'])->name('submitData4');
    Route::get('/grpobenang/detailgrbenang/{id}', [TransaksiGudangController::class, 'detailgrbenang']);


    Route::get('/grpogreige', [TransaksiGudangController::class, 'indexgrgreige']);
    // Route::get('/grpogreige/add', [TransaksiGudangController::class, 'addgrgreige']);
    Route::get('/grpogreige/add/{id}', [TransaksiGudangController::class, 'addgrgreige']);
    Route::post('/submitData5', [TransaksiGudangController::class, 'GrGreigesubmitData'])->name('submitData5');
    Route::get('/grpogreige/detailgrgreige/{id}', [TransaksiGudangController::class, 'detailgrgreige']);


    Route::get('/grtwisting', [TransaksiGudangController::class, 'indexgrtwisting']);
    Route::get('/grtwisting/add/{id}', [TransaksiGudangController::class, 'addgrtwisting']);
    Route::post('/submitData7', [TransaksiGudangController::class, 'GrTwistingsubmitData'])->name('submitData7');
    Route::get('/grtwisting/detailgrtwisting/{id}', [TransaksiGudangController::class, 'detailgrtwisting']);


    Route::get('/grdyeingfinishing', [TransaksiGudangController::class, 'indexgrdf']);
    Route::get('/grdyeingfinishing/add/{id}', [TransaksiGudangController::class, 'addgrdf']);
    Route::post('/submitData9', [TransaksiGudangController::class, 'GrDFsubmitData'])->name('submitData9');
    Route::get('/grdyeingfinishing/detailgrdf/{id}', [TransaksiGudangController::class, 'detailgrdf']);

    Route::get('/kartustok', [KartuStokController::class, 'indexkartustok']);
    Route::post('/kartustok/hitung', [KartuStokController::class, 'hitungkartustok']);
    Route::get('/laporan_kartuStok/cetak', [KartuStokController::class, 'cetak']);
    Route::get('/kartustok/detail/{tahun}-{bulan}-{id_barang}', [KartuStokController::class, 'detail1']);
    Route::get('/kartustok/detailfg/{tahun}-{bulan}-{id_barang}', [KartuStokController::class, 'detailfg1']);

    Route::get('/stokopname', [StockOpnameController::class, 'indexso']);
    Route::get('/stokopname/add', [StockOpnameController::class, 'addso']);
    Route::post('/SOsubmitData', [StockOpnameController::class, 'SOsubmitData'])->name('submitDataSO');
    Route::get('/stokopname/detailso/{id}', [StockOpnameController::class, 'detailso']);

    Route::get('/returbeli', [ReturController::class, 'indexreturbeli']);
    Route::get('/returbeli/add', [ReturController::class, 'addreturbeli']);
    Route::post('/submitDataReturBeli', [ReturController::class, 'RetursubmitData'])->name('submitDataRetur');
    Route::get('/returbeli/detailreturbeli/{id}', [ReturController::class, 'detailreturbeli']);
    Route::get('/returbeli/ajax', [ReturController::class, 'ajax']);
    Route::get('/returbeli/ajax1', [ReturController::class, 'ajax1']);
    Route::get('/returbeli/printsj/{id}', [ReturController::class, 'printsjtw']);
    Route::get('/returbeli/printpl/{id}', [ReturController::class, 'printpltw']);
    Route::get('/returbeli/edit/{id}', [ReturController::class, 'editreturbeli']);
    Route::post('/returbeli/update/{id}', [ReturController::class, 'updatereturbeli']);

    Route::get('/returjual', [ReturController::class, 'indexreturjual']);
    Route::get('/returjual/add', [ReturController::class, 'addreturjual']);
    Route::post('/submitDataReturjual', [ReturController::class, 'RetursubmitDataJual'])->name('submitDataReturJual');
    Route::get('/returjual/detailreturjual/{id}', [ReturController::class, 'detailreturjual']);
    Route::get('/returbeli/ajax', [ReturController::class, 'ajax']);
    Route::get('/returbeli/ajax1', [ReturController::class, 'ajax1']);
    Route::get('/returbeli/printsj/{id}', [ReturController::class, 'printsjtw']);
    Route::get('/returbeli/printpl/{id}', [ReturController::class, 'printpltw']);
    Route::get('/returjual/edit/{id}', [ReturController::class, 'editreturjual']);
    Route::post('/returjual/update/{id}', [ReturController::class, 'updatereturjual']);
});
