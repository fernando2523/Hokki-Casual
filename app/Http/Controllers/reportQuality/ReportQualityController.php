<?php

namespace App\Http\Controllers\reportQuality;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Store;
use App\Models\Sale;

class ReportQualityController extends Controller
{
    public function quality()
    {
        $title = "Report Quality";
        $store = Store::all();

        return view('reportQuality/quality', compact(
            'title',
            'store',
        ));
    }

    public function load_report_quality(Request $request)
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
            } else {
                $get_qty = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->sum('qty');
                $get_gross = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end]);
                $get_discitem = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->sum('diskon_item');
                $get_costs = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end]);
            }

            return view('reportQuality/load_report_quality', compact(
                'store',
                'start',
                'end',
                'get_gross',
                'get_qty',
                'get_discitem',
                'get_costs',
            ));
        }
    }

    public function tablereportquality(Request $request, $store, $start, $end)
    {
        if ($request->ajax()) {

            if ($store === 'ALL') {
                $product = Sale::latest()
                    ->selectRaw('*,SUM(qty) as qty,SUM(selling_price*qty) as selling_price,SUM(diskon_item) as diskon_item,SUM(m_price*qty) as costs')
                    ->whereBetween('tanggal', [$start, $end])
                    ->groupBy('quality')
                    ->get();
            } else {
                $product = Sale::latest()
                    ->selectRaw('*,SUM(qty) as qty,SUM(selling_price*qty) as selling_price,SUM(diskon_item) as diskon_item,SUM(m_price*qty) as costs')
                    ->where('id_store', $store)
                    ->whereBetween('tanggal', [$start, $end])
                    ->groupBy('quality')
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
}
