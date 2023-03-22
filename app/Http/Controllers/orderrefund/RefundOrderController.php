<?php

namespace App\Http\Controllers\orderrefund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;
use App\Models\Cancel_order;
use App\Models\Reseller;
use App\Models\Store;

class RefundOrderController extends Controller
{
    public function refund()
    {
        $title = "Refund";

        return view('orderrefund/refund', compact(
            'title'
        ));
    }

    public function tablerefund(Request $request)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('tipe_refund', '=', 'REFUND')->groupBy('id_transaction');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_refund(Request $request, $id_transaction)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('id_transaction', '=', $id_transaction)->where('tipe_refund', '=', 'REFUND')->groupBy('produk', 'size');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function rincian_refund(Request $request)
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

            return view('orderrefund/rincian_refund', compact(
                'id_transaction',
                'desc',
                'getdata',
                'discount',
                'getstore',
            ));
        }
    }
}
