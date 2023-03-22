<?php

namespace App\Http\Controllers\reportSummary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\Store_equipment_cost;
use App\Models\Store;

class ReportSummaryController extends Controller
{
    public function summary()
    {
        $title = "Report Summary";
        $store = Store::all();

        return view('reportSummary/summary', compact(
            'title',
            'store'
        ));
    }

    public function load_header(Request $request)
    {
        $store = $request->store;
        $start = $request->start;
        $end = $request->end;

        if ($store === 'ALL') {
            $nota = Sale::selectRaw('count(DISTINCT id_invoice) as id_invoice')->whereBetween('tanggal', [$start, $end])->get('id_invoice');
            $qty = Sale::whereBetween('tanggal', [$start, $end])->sum('qty');
            $ongkir = Sale::selectRaw('ongkir')->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get();
            $gross_sale = Sale::whereBetween('tanggal', [$start, $end])->get();
            $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->sum('total_price');
            $discount_item = Sale::whereBetween('tanggal', [$start, $end])->sum('diskon_item');
            $discount_all = Sale::selectRaw('diskon_all')->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get('diskon_all');
            $cost = Sale::whereBetween('tanggal', [$start, $end])->get();
        } else {
            $nota = Sale::selectRaw('count(DISTINCT id_invoice) as id_invoice')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->get('id_invoice');
            $qty = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->sum('qty');
            $ongkir = Sale::selectRaw('ongkir')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get();
            $gross_sale = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->get();
            $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->where('store', $store)->sum('total_price');
            $discount_item = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->sum('diskon_item');
            $discount_all = Sale::selectRaw('diskon_all')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->get('diskon_all');
            $cost = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->get();
        }

        return view('reportSummary.load_header', compact(
            'nota',
            'qty',
            'ongkir',
            'gross_sale',
            'expenses',
            'discount_item',
            'discount_all',
            'cost',
        ));
    }

    public function load_tbsummary(Request $request)
    {
        $querys_result = $request->querys;
        $last_id = $request->last_id;
        $pages = $request->pages;
        $limit = 10;
        $current_page = ($pages * $limit) - ($limit - 1);

        $store = $request->store;
        $start = $request->start;
        $end = $request->end;

        if ($store === 'ALL') {
            if ($last_id == '0') {
                if ($querys_result == '') {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->whereBetween('tanggal', [$start, $end])
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('id_reseller', $querys_result)
                        ->orwhere('produk',  'Like', '%' . $querys_result . '%')
                        ->orwhere('id_produk',  $querys_result)
                        ->orwhere('id_invoice', $querys_result)
                        ->orwhere('users', $querys_result)
                        // ->whereBetween('tanggal', [$start, $end])
                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys_result == '') {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('id_invoice', '<', $last_id)
                        ->whereBetween('tanggal', [$start, $end])
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where([['id_invoice', '<', $last_id], ['id_reseller', $querys_result]])
                        // ->whereBetween('tanggal', [$start, $end])
                        ->orwhere([['id_invoice', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_produk', $querys_result]])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_invoice', $querys_result]])
                        ->orwhere([['id_invoice', '<', $last_id], ['users', $querys_result]])
                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            }
        } else {
            if ($last_id == '0') {
                if ($querys_result == '') {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('id_store', $store)
                        ->whereBetween('tanggal', [$start, $end])
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('id_reseller', $querys_result)
                        ->where('id_store', $store)
                        ->orwhere('produk',  'Like', '%' . $querys_result . '%')
                        ->orwhere('id_produk',  $querys_result)
                        ->orwhere('id_invoice', $querys_result)
                        ->orwhere('users', $querys_result)
                        // ->whereBetween('tanggal', [$start, $end])
                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys_result == '') {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('id_invoice', '<', $last_id)
                        ->where('id_store', $store)
                        ->whereBetween('tanggal', [$start, $end])
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details2', 'store')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where([['id_invoice', '<', $last_id], ['id_reseller', $querys_result]])
                        ->where('id_store', $store)
                        // ->whereBetween('tanggal', [$start, $end])
                        ->orwhere([['id_invoice', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_produk', $querys_result]])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_invoice', $querys_result]])
                        ->orwhere([['id_invoice', '<', $last_id], ['users', $querys_result]])
                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            }
        }

        $count = count($data);

        if ($last_id == 'last') {
        } else {
            return view('reportSummary.load_tbsummary', compact(
                'data',
                'count',
                'current_page',
                'store',
                'start',
                'end'
            ));
        }
    }
}
