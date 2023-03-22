<?php

namespace App\Http\Controllers\ordercancel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cancel_order;
use App\Models\Reseller;
use App\Models\Store;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;

class CancelOrderController extends Controller
{
    public function cancel()
    {
        $title = "Cancel Order";
        // $getdata = DB::table('cancel_orders')
        //     ->where('id_invoice', '=', '1105496')
        //     ->select(DB::raw('id_invoice'), DB::raw('id_reseller'), DB::raw('tanggal'), DB::raw('id_store'), DB::raw('SUM(qty) as totalqty'), DB::raw('SUM(diskon_item) as diskon_items'), DB::raw('SUM(diskon_all) as diskon_alls'))
        //     ->groupBy('id_invoice')->get();

        // $hasil = intval($getdata[0]->diskon_items) + intval($getdata[0]->diskon_alls);
        // dd($hasil);

        return view('ordercancel/cancel', compact(
            'title'
        ));
    }

    public function tablecancel(Request $request)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('tipe_refund', '=', 'CANCEL')->groupBy('id_transaction');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_cancel(Request $request, $id_transaction)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->selectRaw("*,SUM(qty) as qtys")->where('id_transaction', '=', $id_transaction)->where('tipe_refund', '=', 'CANCEL')->groupBy('produk', 'size');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function rincian_cancel(Request $request)
    {
        if ($request->ajax()) {
            $id_transaction = $request->id_transaction;
            $desc = $request->desc;
            $getdata = Cancel_order::where('id_transaction', '=',  $id_transaction)
                ->selectRaw("*,SUM(qty) as totalqty,SUM(diskon_item) as diskon_items,diskon_all as diskon_alls,grandtotal as grandtotals")
                ->groupBy('id_transaction')
                ->get();

            $discount = intval($getdata[0]->diskon_items) + intval($getdata[0]->diskon_alls);

            $getstore = Store::where('id_store', '=', $getdata[0]->id_store)->get();

            return view('ordercancel/rincian_cancel', compact(
                'id_transaction',
                'desc',
                'getdata',
                'discount',
                'getstore',
            ));
        }
    }
}
