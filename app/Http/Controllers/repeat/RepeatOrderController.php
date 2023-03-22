<?php

namespace App\Http\Controllers\repeat;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Sub_category;
use App\Models\warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use App\Models\Variation_history;
use App\Models\Image_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class RepeatOrderController extends Controller
{
    public function repeatorders()
    {
        $title = "Repeat Order";
        $getbrand = Brand::all();
        $getcategory = Sub_category::all();
        $getware = Warehouse::all();
        $getsupplier = DB::table('suppliers')->orderBy('id_sup', 'desc')->get();
        $get_Supplier_Order = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('id_sup'),)->groupBy('idpo', 'tanggal', 'id_sup')->orderBy('idpo', 'desc')->limit(10)->get();

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();



        return view('repeat/repeatorders', compact(
            'title',
            'selectWarehouse',
            'getbrand',
            'getcategory',
            'getware',
            'getsupplier',
            'get_Supplier_Order',
            'userware'
        ));
    }

    public function detail_repeat_order(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;

            return view('repeat/detail_repeat_order', compact(
                'id_ware',
            ));
        }
    }

    public function tablerepeatorder(Request $request, $id_ware)
    {
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->pluck('id_area');
        $userware2 = $userware->toArray();
        $userware3 = implode(" ", $userware2);

        if ($request->ajax()) {
            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation2');
            } elseif ($id_ware === "per_area") {
                $product = Product::with('warehouse', 'image_product', 'product_variation2')
                    ->where('id_area', '=', $userware3);
            } else {
                $product = Product::with('warehouse', 'image_product', 'product_variation2')
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
    public function load_repeatorder(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $id_produk = $request->id_produk;
            $id_area = $request->id_area;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            // $m_price = $request->m_price;
            $brand = $request->brand;

            $getsupplier = Supplier::all();
            $variationss = variation::with('products')->selectRaw('*,sum(qty) as qty')->where('id_ware', $id_ware)->where('id_produk', $id_produk)->groupBy('size', 'id_produk')->get();
            $variationss_default = variation::groupBy('size', 'id_produk')->get();
            // $variationss = Product::with('product_variation3')->get();
            $get_Supplier_Order = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('id_sup'),)->groupBy('idpo', 'tanggal', 'id_sup')->orderBy('idpo', 'desc')->limit(10)->get();
            $get_m_price = DB::table('supplier_orders')->select(DB::raw('m_price'), DB::raw('id_produk'), DB::raw('idpo'))->where('id_produk', '=', $id_produk)->groupBy('id_produk', 'idpo')->orderBy('idpo', 'desc')->first('m_price');

            return View('repeat/load_repeatorder', compact(
                'id',
                'id_produk',
                'id_area',
                'id_ware',
                'produk',
                // 'm_price',
                'brand',
                'getsupplier',
                'variationss',
                'variationss_default',
                'get_Supplier_Order',
                'get_m_price'
            ));
        }
    }

    public function table_detail_repeatorder(Request $request, $id_ware, $id_produk)
    {
        if ($request->ajax()) {
            $supplier = Supplier_order::with('supplier_variation', 'suppliers_detail')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->get();

            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->make(true);
        }
    }

    public function repeats(Request $request)
    {
        $getuser = Auth::user()->name;

        $now = Carbon::now('Asia/Bangkok');
        $tanggalskrg = Date('Y-m-d');

        $thn_bln = $now->format('ym');
        $ceks = Supplier_order::count();
        if ($ceks === 0) {
            $urut2 = 1;
            $get_idpo = $thn_bln . sprintf("%04s", ($urut2));
        } else {
            $ambildatas = Supplier_order::all()->last();
            $ceks2 = (int)substr($ambildatas->idpo, 4) + 1;
            $get_idpo = $thn_bln . sprintf("%04s", + ($ceks2));
        }
        //END GET IDPO

        //GET ID HISTORY
        $thn_bln_tgl = $now->format('ymd');
        $hitung = Variation_history::count();
        if ($hitung === 0) {
            $urut3 = 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Variation_history::all()->last();
            $hitung2 = (int)substr($ambildatas2->id_history, 6) + 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }

        $cek_data = Supplier_order::sharedLock()->count();
        if ($cek_data === 0) {
            $urut_data = 1;
            $get_act = sprintf("%04s", ($urut_data));
        } else {
            $ambildata_1 = DB::table('supplier_orders')->sharedLock()->select(DB::raw('id_act'))->max('id_act');
            $cek_data2 = (int)substr($ambildata_1, 0) + 1;
            $get_act = sprintf("%04s", + ($cek_data2));
        }
        //END ID HISTORY
        $get_supplier_Lama = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('id_sup'),)->where('idpo', '=', $request->id_po_lama)->groupBy('idpo', 'id_sup')->pluck('id_sup');
        $get_supplier_Lama2 = $get_supplier_Lama->toArray();
        $get_supplier_Lama3 = implode(" ", $get_supplier_Lama2);

        $getselectedwarehouse = DB::table('warehouses')->where('id_ware', '=', $request->id_ware)->select(DB::raw('id_ware'), DB::raw('id_area'),)->get();
        $qtys = 0;
        if ($request->type_po === "baru") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION
                $data2 = new variation();
                $data2->tanggal = $tanggalskrg;
                $data2->id_produk = $request->id_produk;
                $data2->idpo = $get_idpo;
                $data2->id_area = $getselectedwarehouse[0]->id_area;
                $data2->id_ware = $request->id_ware;
                $data2->id_act = $get_act;
                $data2->users = $getuser;
                $data2->size = $request->size[$i];
                $data2->qty = $request->qty[$i];
                $data2->save();
                $qtys =  $qtys + $request->qty[$i];
                //END DB VARIATION

                //DB SUPPLIER VARIATIONS
                $data4 = new Supplier_variation();
                $data4->idpo = $get_idpo;
                $data4->id_sup = $request->id_sup;
                $data4->id_produk = $request->id_produk;
                $data4->id_area = $getselectedwarehouse[0]->id_area;
                $data4->id_ware = $request->id_ware;
                $data4->tanggal = $tanggalskrg;
                $data4->size = $request->size[$i];
                $data4->qty = $request->qty[$i];
                $data4->tipe_order = "REPEAT";
                $data4->id_act = $get_act;
                $data4->users = $getuser;
                $data4->save();
                //END DB SUPPLIER VARIATIONS

                //DB VARIATIONS_HISTORIES
                $data5 = new Variation_history();
                $data5->tanggal = $tanggalskrg;
                $data5->id_history = $get_idhistory;
                $data5->id_produk = $request->id_produk;
                $data5->id_ware = $request->id_ware;
                $data5->size = $request->size[$i];
                $data5->qty = $request->qty[$i];
                $data5->users = $getuser;
                $data5->save();
                //END DB VARIATIONS_HISTORIES
            }
            //DB SUPPLIER ORDER
            $data3 = new Supplier_order();
            $data3->idpo = $get_idpo;
            $data3->id_sup = $request->id_sup;
            $data3->id_produk = $request->id_produk;
            $data3->id_ware = $getselectedwarehouse[0]->id_ware;
            $data3->brand = $request->brand;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = intval(preg_replace("/[^0-9]/", "", $request->m_price)) * intval($qtys);
            $data3->tipe_order = "REPEAT";
            $data3->id_act = $get_act;
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        } elseif ($request->type_po === "lama") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION

                $data2 = new variation();
                $data2->tanggal = $tanggalskrg;
                $data2->id_produk = $request->id_produk;
                $data2->idpo = $request->id_po_lama;
                $data2->id_area = $getselectedwarehouse[0]->id_area;
                $data2->id_ware = $request->id_ware;
                $data2->id_act = $get_act;
                $data2->users = $getuser;
                $data2->size = $request->size[$i];
                $data2->qty = $request->qty[$i];
                $data2->save();
                $qtys =  $qtys + $request->qty[$i];
                //END DB VARIATION

                //DB SUPPLIER VARIATIONS
                $data4 = new Supplier_variation();
                $data4->idpo = $request->id_po_lama;
                $data4->id_sup = $get_supplier_Lama3;
                $data4->id_produk = $request->id_produk;
                $data4->id_area = $getselectedwarehouse[0]->id_area;
                $data4->id_ware = $request->id_ware;
                $data4->tanggal = $tanggalskrg;
                $data4->size = $request->size[$i];
                $data4->qty = $request->qty[$i];
                $data4->tipe_order = "REPEAT";
                $data4->id_act = $get_act;
                $data4->users = $getuser;
                $data4->save();
                //END DB SUPPLIER VARIATIONS

                //DB VARIATIONS_HISTORIES
                $data5 = new Variation_history();
                $data5->tanggal = $tanggalskrg;
                $data5->id_history = $get_idhistory;
                $data5->id_produk = $request->id_produk;
                $data5->id_ware = $request->id_ware;
                $data5->size = $request->size[$i];
                $data5->qty = $request->qty[$i];
                $data5->users = $getuser;
                $data5->save();
                //END DB VARIATIONS_HISTORIES
            }
            //DB SUPPLIER ORDER
            $data3 = new Supplier_order();
            $data3->idpo = $request->id_po_lama;
            $data3->id_sup = $get_supplier_Lama3;
            $data3->id_produk = $request->id_produk;
            $data3->id_ware = $request->id_ware;
            $data3->brand = $request->brand;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = intval(preg_replace("/[^0-9]/", "", $request->m_price)) * intval($qtys);
            $data3->tipe_order = "REPEAT";
            $data3->id_act = $get_act;
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        }

        return redirect('repeat/repeatorders');
    }
}
