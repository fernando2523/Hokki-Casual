<?php

namespace App\Http\Controllers\purchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderController extends Controller
{

    public function purchaseorder()
    {

        $title = "Purchase Order";
        $datapo = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('users'),)->groupBy('idpo', 'tanggal', 'users')->limit(10)->get();
        $datapoDetail = Supplier_order::all();
        $datamodal = DB::table('supplier_orders')->select(DB::raw('SUM(m_price) as modals'), DB::raw('idpo'),)->groupBy('idpo')->get();
        $datasubtotal = DB::table('supplier_orders')->select(DB::raw('SUM(subtotal) as subtotals'), DB::raw('idpo'),)->groupBy('idpo')->get();
        $supplier = Supplier::all();
        $datatotalqty = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as total_qty'), DB::raw('idpo'),)->groupBy('idpo')->get();

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('purchase/purchaseorder', compact(
            'title',
            'datapo',
            'datapoDetail',
            'datamodal',
            'datasubtotal',
            'supplier',
            'datatotalqty',
            'selectWarehouse',
            'userware'
        ));
    }

    public function load_table_po(Request $request)
    {
        // if ($request->ajax()) {
        $querys = $request->querys;
        $last_id = $request->last_id;
        $pages = $request->pages;
        $type = $request->type;

        $limit = 10;
        $current_page = ($pages * $limit) - ($limit - 1);

        $warehouse = Warehouse::all();

        if ($type === 'all_type') {
            if ($last_id == '0') {
                if ($querys == '') {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                } else {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where('idpo', $querys)
                        ->orwhere('produk', 'LIKE', '%' . $querys . '%')
                        ->orwhere('id_produk', 'LIKE', '%' . $querys . '%')
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys == '') {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where('id', '<', $last_id)
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                } else {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where([['id', '<', $last_id], ['idpo', $querys]])
                        ->orwhere([['id', '<', $last_id], ['produk', $querys]])
                        ->orwhere([['id', '<', $last_id], ['id_produk', 'LIKE', '%' . $querys . '%']])
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                }
            }
        } else {
            if ($last_id == '0') {
                if ($querys == '') {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where('tipe_order', $type)
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                } else {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where('idpo', $querys)
                        ->where('tipe_order', $type)
                        ->orwhere('produk', 'LIKE', '%' . $querys . '%')
                        ->orwhere('id_produk', 'LIKE', '%' . $querys . '%')
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys == '') {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where('id', '<', $last_id)
                        ->where('tipe_order', $type)
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                } else {
                    $datapo = Supplier_order::with('suppliers_details', 'suppliers_detail', 'supplier_variation', 'products', 'warehouse3')
                        ->where([['id', '<', $last_id], ['idpo', $querys]])
                        ->where('tipe_order', $type)
                        ->orwhere([['id', '<', $last_id], ['produk', $querys]])
                        ->orwhere([['id', '<', $last_id], ['id_produk', 'LIKE', '%' . $querys . '%']])
                        ->orderBy('idpo', 'DESC')
                        ->groupBy('idpo', 'tanggal', 'users')
                        ->limit(10)
                        ->get();
                }
            }
        }


        $count = count($datapo);

        return view('load.load_tb_po', compact(
            'datapo',
            'count',
            'current_page',
            'warehouse'
        ));
        // }
    }

    public function load_purchase_order(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $get_variation = Supplier_variation::all();

            return view('purchase/load_purchase_order', compact(
                'idpo',
                'id_produk',
                'id_ware',
                'produk',
                'get_variation'
            ));
        }
    }

    public function load_header_po(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->type;

            if ($type === 'all_type') {
                $totalpo = Supplier_order::all('idpo')->groupBy('idpo')->count('idpo');
                $totalmodal = Supplier_order::all('subtotal')->sum('subtotal');
            } else {
                $totalpo = Supplier_order::where('tipe_order', $type)->groupBy('idpo')->count('idpo');
                $totalmodal = Supplier_order::where('tipe_order', $type)->sum('subtotal');
            }

            return view('purchase.load_header', compact(
                'totalpo',
                'totalmodal'
            ));
        }
    }

    public function load_details_po(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $id_act = $request->id_act;

            $data = Supplier_variation::where('idpo', $idpo)->where('id_produk', $id_produk)->where('id_ware', $id_ware)->where('id_act', $id_act)->get();

            return view('load.load_detailspo', compact(
                'data'
            ));
        }
    }

    public function load_edit_po(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $id_act = $request->id_act;

            $datapo = Supplier_order::with('suppliers_detail')->where('idpo', $idpo)->where('id_produk', $id_produk)->where('id_ware', $id_ware)->where('id_act', $id_act)->get();
            $supplier = Supplier::where('id_sup', '!=', $datapo[0]['id_sup'])->get();
            $data = Supplier_variation::where('idpo', $idpo)->where('id_produk', $id_produk)->where('id_ware', $id_ware)->where('id_act', $id_act)->get();

            return view('load.load_editdetailspo', compact(
                'data',
                'datapo',
                'supplier',
                'idpo',
                'id_produk',
                'id_ware'
            ));
        }
    }

    public function purchase_variation(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $id_sup = $request->id_sup;
            $m_price = $request->m_price;
            $tipe_order = $request->tipe_order;
            $id_act = $request->id_act;
            $variationss = Supplier_variation::all();

            return view('purchase/purchase_variation', compact(
                'idpo',
                'id_act',
                'id_produk',
                'id_ware',
                'produk',
                'id_sup',
                'm_price',
                'tipe_order',
                'variationss'
            ));
        }
    }

    public function deleteItem(Request $request)
    {
        $id = $request->d_id;

        $get_po = Supplier_order::where('id', $id)->get();

        variation::where('idpo', $get_po[0]['idpo'])
            ->where('id_produk', $get_po[0]['id_produk'])
            ->where('id_act', $get_po[0]['id_act'])
            ->delete();

        Supplier_variation::where('idpo', $get_po[0]['idpo'])
            ->where('id_produk', $get_po[0]['id_produk'])
            ->where('id_act', $get_po[0]['id_act'])
            ->delete();

        Supplier_order::where('id', $id)->delete();

        return redirect('purchase/purchaseorder');
    }

    public function deletePo(Request $request)
    {
        $idpo = $request->d_idpo;

        variation::where('idpo', $idpo)->delete();
        Supplier_variation::where('idpo', $idpo)->delete();
        Supplier_order::where('idpo', $idpo)->delete();

        return redirect('purchase/purchaseorder');
    }

    public function edit_po(Request $request)
    {
        $idpo = $request->idpo;
        $idpo_new = $request->idpo_new;
        $id_produk = $request->id_produk;
        $id_sup = $request->id_sup;
        $m_price = $request->m_price;
        $tipe_order = $request->tipe_order;
        $size = $request->size;
        $qty_old = $request->qty_old;
        $qty_new = $request->qty_new;

        $total_qty = 0;

        for ($i = 0; $i < count($request->size); $i++) {
            $total_qty = $total_qty + intval($qty_new[$i]);

            Supplier_variation::where('idpo', $idpo)
                ->where('id_produk', $id_produk)
                ->where('size', $size[$i])
                ->update([
                    'idpo' =>  $idpo_new,
                    'id_sup' =>  $id_sup,
                    'qty' =>  $qty_new[$i],
                    'tipe_order' =>  $tipe_order,
                ]);

            $data_var = variation::where('idpo', $idpo)
                ->where('id_produk', $id_produk)
                ->where('size', $size[$i])
                ->get();


            $qty_result = intval($qty_new[$i]) - intval($qty_old[$i]);

            variation::where('idpo', $idpo)
                ->where('id_produk', $id_produk)
                ->where('size', $size[$i])
                ->update([
                    'idpo' =>  $idpo_new,
                    'qty' =>  intval($data_var[0]['qty'])  + intval($qty_result),
                ]);
        }

        Supplier_order::where('idpo', $idpo)
            ->where('id_produk', $id_produk)
            ->update([
                'idpo' =>  $idpo_new,
                'id_sup' =>  $id_sup,
                'm_price' =>  $m_price,
                'subtotal' =>  intval($m_price) * intval($total_qty),
                'tipe_order' =>  $tipe_order,
                'qty' => $total_qty,
            ]);

        return redirect('purchase/purchaseorder');
    }
}
