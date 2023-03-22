<?php

namespace App\Http\Controllers\orderreturn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;
use App\Models\Return_order;
use App\Models\Reseller;
use App\Models\Store;

class ReturnOrderController extends Controller
{
    public function return()
    {
        $title = "Return";

        return view('orderreturn/return', compact(
            'title'
        ));
    }

    public function tablereturn(Request $request)
    {
        if ($request->ajax()) {
            $data = Return_order::with('stores', 'warehouses')->groupBy('id_transaction');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_return(Request $request, $id_transaction)
    {
        if ($request->ajax()) {
            $data = Return_order::with('stores', 'warehouses')->where('id_transaction', '=', $id_transaction)->groupBy('produk', 'size');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function rincian_return(Request $request)
    {
        if ($request->ajax()) {
            $id_transaction = $request->id_transaction;
            $desc = $request->desc;
            $getdata = Return_order::where('id_transaction', '=',  $id_transaction)
                ->selectRaw("*,SUM(qty_new) as totalqty,SUM(diskon_item) as diskon_items,diskon_all as diskon_alls,grandtotal as grandtotals")
                ->groupBy('id_transaction')
                ->get();

            $discount = intval($getdata[0]->diskon_items) + intval($getdata[0]->diskon_alls);

            $getstore = Store::where('id_store', '=', $getdata[0]->id_store)->get();

            return view('orderreturn/rincian_return', compact(
                'id_transaction',
                'desc',
                'getdata',
                'discount',
                'getstore',
            ));
        }
    }
}
