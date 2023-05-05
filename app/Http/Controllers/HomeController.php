<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderModel;
use App\Models\TransaksiGudangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = date('Y-m-d');
        $bulan = date('m');
        $poinprogress = PurchaseOrderModel::where('status','=','In Progress')->count();
        $brg_masuk_today = TransaksiGudangModel::where('id_transaksi', 'like', 'R%')
                            ->where('Tanggal', '=', $date)
                            ->count();
        $brg_masuk_month = TransaksiGudangModel::where('id_transaksi', 'like', 'R%')
                            ->whereMonth('Tanggal', '=', $bulan)
                            ->count();
        $brg_keluar_month = TransaksiGudangModel::where('id_transaksi', 'NOT like', 'R%')
                            ->whereMonth('Tanggal', '=', $bulan)
                            ->count();
        $brg_keluar_today = TransaksiGudangModel::where('id_transaksi', 'NOT like', 'R%')
                            ->where('Tanggal', '=', $date)
                            ->count();
        return view('home', compact('poinprogress','brg_masuk_today','brg_keluar_month','brg_keluar_today','brg_masuk_month'));
    }
}
