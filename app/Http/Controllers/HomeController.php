<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Sale;
use App\Models\Store_equipment_cost;

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
        $title = "Dashboard";
        $store = Store::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('dashboard.dashboards', compact(
            'title',
            'store',
            'userware'
        ));
    }

    public function load_db(Request $request)
    {
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();
        $store = $request->store;
        $start = $request->start;
        $end = $request->end;
        
        // elseif ($store === 'per_area') {
        //     $get_sales = Sale::all()->where('id_area',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->count('id_invoice');
        //     $get_qty = Sale::all()->where('id_area',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->sum('qty');
        //     $get_expense = Store_equipment_cost::all()->where('store',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->sum('total_price');

        //     $get_payment = DB::table('sales')->select(DB::raw('cash as cashs'), DB::raw('bca as bcas'), DB::raw('mandiri as mandiris'), DB::raw('qris as qriss'))->where('id_area',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get();
        //     $getTop_product = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('produk'), DB::raw('id_brand'))->where('id_area',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->groupBy('id_produk')->limit(10)->get();
        //     $getTop_reseller = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('id_reseller'))->where('customer', '=', 'RESELLER')->where('id_area',  $userware[0]->id_area)->whereBetween('tanggal', [$start, $end])->groupBy('id_reseller')->limit(10)->get();
        // }

        if ($store === 'ALL') {
            $get_sales = Sale::all()->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->count('id_invoice');
            $get_qty = Sale::all()->whereBetween('tanggal', [$start, $end])->sum('qty');
            $get_expense = Store_equipment_cost::all()->whereBetween('tanggal', [$start, $end])->sum('total_price');

            $get_payment = Sale::selectRaw('*,SUM(subtotal) as subs,cash as cashs,mandiri as mandiris,qris as qriss,bca as bcas')->whereBetween('tanggal', [$start, $end])->where('payment', 'PAID')->groupBy('id_invoice')->get();
            $getTop_product = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('produk'), DB::raw('id_brand'))->whereBetween('tanggal', [$start, $end])->orderBy('qtys','desc')->groupBy('id_produk')->limit(10)->get();
            $getTop_reseller = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('id_reseller'))->where('customer', '=', 'RESELLER')->whereBetween('tanggal', [$start, $end])->orderBy('qtys','desc')->groupBy('id_reseller')->limit(10)->get();
        }  else {
            $store_name = DB::table('stores')->where('id_store', $store)->get();
            
            $get_sales = Sale::all()->where('id_store', $store)->where('payment', "PAID")->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->count('id_invoice');
            $get_qty = Sale::all()->where('id_store', $store)->where('payment', "PAID")->whereBetween('tanggal', [$start, $end])->sum('qty');
            $get_expense = Store_equipment_cost::all()->where('store', $store_name[0]->store)->whereBetween('tanggal', [$start, $end])->sum('total_price');

            // $get_payment = DB::table('sales')->select(DB::raw('cash as cashs'), DB::raw('bca as bcas'), DB::raw('mandiri as mandiris'), DB::raw('qris as qriss'))->where('id_store', $store)->where('payment', 'PAID')->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get();
            $get_payment = Sale::selectRaw('*,SUM(subtotal) as subs,cash as cashs,mandiri as mandiris,qris as qriss,bca as bcas')->whereBetween('tanggal', [$start, $end])->where('id_store', $store)->where('payment', 'PAID')->groupBy('id_invoice')->get();
            
            $getTop_product = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('produk'), DB::raw('id_brand'))->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->orderBy('qtys','desc')->groupBy('id_produk')->limit(10)->get();
            $getTop_reseller = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('id_reseller'))->where('customer', '=', 'RESELLER')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->orderBy('qtys','desc')->groupBy('id_reseller')->limit(10)->get();
        }

        if (count($get_payment) > 0) {
            $payment = 0;

            $cash = 0;
            $bca = 0;
            $mandiri = 0;
            $qris = 0;

            for ($i = 0; $i < count($get_payment); $i++) {
                $jumlah = intval(intval($get_payment[$i]->cashs) + intval($get_payment[$i]->bcas) + intval($get_payment[$i]->mandiris) + intval($get_payment[$i]->qriss));
                
                if( $jumlah > intval($get_payment[$i]->subs)){
                    $payment = $payment + intval($get_payment[$i]->subs);
                    
                    if( intval($get_payment[$i]->cashs) > intval($get_payment[$i]->subs)){
                        $cash = $cash + intval($get_payment[$i]->subs);
                    }else{
                        $cash = $cash + intval($get_payment[$i]->cashs);
                    }
                    
                    if( intval($get_payment[$i]->bcas) > intval($get_payment[$i]->subs)){
                        $bca = $bca + intval($get_payment[$i]->subs);
                    }else{
                        $bca = $bca + intval($get_payment[$i]->bcas);
                    }
                    
                    
                    if( intval($get_payment[$i]->mandiris) > intval($get_payment[$i]->subs)){
                        $mandiri = $mandiri + intval($get_payment[$i]->subs);
                    }else{
                        $mandiri = $mandiri + intval($get_payment[$i]->mandiris);
                    }
                    
                    
                    if( intval($get_payment[$i]->cashs) > intval($get_payment[$i]->subs)){
                        $qris = $qris + intval($get_payment[$i]->subs);
                    }else{
                        $qris = $qris + intval($get_payment[$i]->qriss);
                    }
                    
                }else{
                    $payment = $payment + (intval($get_payment[$i]->cashs) + intval($get_payment[$i]->bcas) + intval($get_payment[$i]->mandiris) + intval($get_payment[$i]->qriss));
                    
                    if( intval($get_payment[$i]->cashs) > intval($get_payment[$i]->subs)){
                        $cash = $cash + intval($get_payment[$i]->subs);
                    }else{
                        $cash = $cash + intval($get_payment[$i]->cashs);
                    }
                    
                    if( intval($get_payment[$i]->bcas) > intval($get_payment[$i]->subs)){
                        $bca = $bca + intval($get_payment[$i]->subs);
                    }else{
                        $bca = $bca + intval($get_payment[$i]->bcas);
                    }
                    
                    
                    if( intval($get_payment[$i]->mandiris) > intval($get_payment[$i]->subs)){
                        $mandiri = $mandiri + intval($get_payment[$i]->subs);
                    }else{
                        $mandiri = $mandiri + intval($get_payment[$i]->mandiris);
                    }
                    
                    
                    if( intval($get_payment[$i]->cashs) > intval($get_payment[$i]->subs)){
                        $qris = $qris + intval($get_payment[$i]->subs);
                    }else{
                        $qris = $qris + intval($get_payment[$i]->qriss);
                    }
                }
            }

            $getTotalpayment = $payment - $get_expense;
            $totalpayment = $payment;
        } else {
            $cash = 0;
            $bca = 0;
            $mandiri = 0;
            $qris = 0;
            $payment = 0;
            $getTotalpayment = $payment - $get_expense;
            $totalpayment = $payment;
        }

        return view('dashboard.load_dashboard', compact(
            'get_sales',
            'get_qty',
            'get_expense',
            'get_payment',
            'getTop_product',
            'getTop_reseller',
            'getTotalpayment',
            'store',
            'start',
            'end',
            'cash',
            'bca',
            'mandiri',
            'qris',
            'totalpayment'
        ));
    }
}
