<?php

namespace App\Http\Controllers\barcode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Store;
use App\Models\variation;
use App\Models\warehouse;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;

class BarcodeController extends Controller
{
    public function barcodes()
    {
        $title = "Barcode";

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('barcode.barcodes', compact(
            'title',
            'selectWarehouse',
            'userware'
        ));
    }

    public function load_barcode(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;

            return view('barcode/load_barcode', compact(
                'id_ware',
            ));
        }
    }

    public function tablebarcode(Request $request, $id_ware)
    {
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->pluck('id_area');
        $userware2 = $userware->toArray();
        $userware3 = implode(" ", $userware2);

        if ($request->ajax()) {
            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas');
            } elseif ($id_ware === "per_area") {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')
                    ->where('id_area', '=', $userware3);
            } else {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')
                    ->where('id_ware', '=', $id_ware);
            }

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function barcode_detail(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $id_area = $request->id_area;
            $val = $request->val;

            $get_variation = DB::table('variations')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->groupBy('size')->get();

            $get_idpo = DB::table('supplier_orders')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->groupBy('idpo')->get();

            // $get_idpo_variation = DB::table('supplier_variations')
            //     ->where('id_ware', $id_ware)
            //     ->where('id_produk', $id_produk)
            //     ->groupBy('size')->get();

            return view('barcode/barcode_detail', compact(
                'id_produk',
                'id_ware',
                'id_area',
                'get_variation',
                'get_idpo',
                'val'
            ));
        }
    }
    public function select_size_po(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->value;
            $id_produk = $request->v_id_produk;
            $id_ware = $request->v_id_ware;

            $get_idpo_variation = DB::table('supplier_variations')
                ->where('id_produk', $id_produk)
                ->where('idpo', $idpo)
                ->groupBy('size')
                ->get();

            return view('barcode/select_size_po', compact(
                'idpo',
                'get_idpo_variation'
            ));
        }
    }

    public function printtest(Request $request)
    {
        $size = $request->size;
        $qty = $request->qty;
        $idpo = $request->idpo;
        $v_id_produk = $request->v_id_produk;
        $v_id_ware = $request->v_id_ware;
        $produk = $request->v_produk;

        $data = [
            'size' => $size,
            'qty' => $qty,
            'v_id_produk' => $v_id_produk,
            'idpo' => $idpo,
            'produk' => $produk,
        ];
        $pdf = MPDF::loadView(
            'print.printtest',
            $data,
            [],
            [
                'format' => 'A5',
                'orientation' => 'L',
                'margin_left' => -0,
                'margin_right ' => -20,
                'margin_top' => -3,
                'margin_bottom' => -30,
                'margin_header' => 0,
                'margin_footer' => -10,
            ]
        );
        ob_get_clean();
        return $pdf->stream('document.pdf');
    }
}
