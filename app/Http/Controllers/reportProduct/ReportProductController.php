<?php

namespace App\Http\Controllers\reportProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Store;
use App\Models\Store_equipment_cost;

class ReportProductController extends Controller
{
    public function product()
    {
        $title = "Report Product";
        $store = Store::all();

        return view('reportProduct/product', compact(
            'title',
            'store'
        ));
    }

    public function load_report_product(Request $request)
    {
        if ($request->ajax()) {
            $store = $request->store;
            $start = $request->start;
            $end = $request->end;

            if ($store === 'ALL') {
                $get_qty = Sale::all()->whereBetween('tanggal', [$start, $end])->sum('qty');
                $get_gross = Sale::all()->whereBetween('tanggal', [$start, $end]);
                $get_discitem = Sale::all()->whereBetween('tanggal', [$start, $end])->sum('diskon_item');
                $get_costs = Sale::all()->whereBetween('tanggal', [$start, $end]);
                $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->sum('total_price');
            } else {
                $get_qty = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->sum('qty');
                $get_gross = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end]);
                $get_discitem = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->sum('diskon_item');
                $get_costs = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end]);
                $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->where('store', $store)->sum('total_price');
            }

            return view('reportProduct/load_report_product', compact(
                'store',
                'start',
                'end',
                'get_gross',
                'get_qty',
                'get_discitem',
                'get_costs',
                'expenses'
            ));
        }
    }

    public function tablereportproduct(Request $request, $store, $start, $end)
    {
        // if ($request->ajax()) {

            if ($store === 'ALL') {
                $product = Sale::selectRaw('*,SUM(qty) as qty')
                    ->with('image_product', 'disc_item', 'disc_all', 'gross', 'costs', 'profit')
                    ->whereBetween('tanggal', [$start, $end])
                    ->groupBy('id_produk')
                    ->get();
            } else {
                $product = Sale::selectRaw('*,SUM(qty) as qty')
                    ->with('image_product', 'disc_item', 'disc_all', 'gross', 'costs', 'profit')
                    ->where('id_store', $store)->whereBetween('tanggal', [$start, $end])
                    ->groupBy('id_produk')
                    ->get();
            }

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
}
