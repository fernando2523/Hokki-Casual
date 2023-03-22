<?php

namespace App\Http\Controllers\productTransfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Image_product;
use App\Models\warehouse;
use App\Models\variation;
use App\Models\Supplier_order;
use App\Models\Variation_history;
use App\Models\Supplier_variation;

class ProductTransferController extends Controller
{
    public function productTransfers()
    {
        $title = "Product Transfer";

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('productTransfer/productTransfers', compact(
            'title',
            'selectWarehouse',
            'userware'
        ));
    }

    public function detail_product_transfer(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;

            return view('productTransfer/detail_product_transfer', compact(
                'id_ware',
            ));
        }
    }

    public function tableproducttransfer(Request $request, $id_ware)
    {
        if ($request->ajax()) {
            $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store);
            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation2');
            } elseif ($id_ware === "per_area") {
                $product = Product::with('warehouse', 'image_product', 'product_variation2')
                    ->where('id_area', '=', $userware[0]->id_area);
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

    public function load_product_transfer(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_area = $request->id_area;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $brand = $request->brand;
            $quality = $request->quality;
            $category = $request->category;

            $dataimg = Image_product::all();
            $getwarehouse_awal = DB::table('warehouses')->where('id_ware', $id_ware)->get();
            $getwarehouse_tujuan = DB::table('warehouses')->get();
            $variationss = DB::table('variations')->select(DB::raw('SUM(qty) as qty'), DB::raw('id_produk'), DB::raw('id_ware'), DB::raw('size'))->where('id_ware', '=', $id_ware)->groupBy('size', 'id_produk')->get();

            return view('productTransfer/load_product_transfer', compact(
                'id_produk',
                'id_area',
                'id_ware',
                'produk',
                'brand',
                'quality',
                'category',
                'dataimg',
                'getwarehouse_awal',
                'getwarehouse_tujuan',
                'variationss'
            ));
        }
    }

    public function transfer(Request $request)
    {
        $produk = $request->produk;
        $id_produk = $request->id_produk;
        $brand = $request->brand;
        $quality = $request->quality;
        $category = $request->category;
        $warehouse_asal = $request->warehouse_asal;
        $warehouse_tujuan = $request->warehouse_tujuan;
        $size = $request->size;
        $qty = $request->qty;

        $selectWarehouse = warehouse::where('id_ware', $warehouse_tujuan)->get();

        $id_area = $selectWarehouse[0]['id_area'];

        $getuser = Auth::user()->name;

        $now = Carbon::now('Asia/Bangkok');
        $tanggalskrg = Date('Y-m-d');

        $thn_bln = $now->format('ym');
        $ceks = Supplier_order::count();
        if ($ceks === 0) {
            $urut2 = 1;
            $get_idpo = $urut2;
        } else {
            $ambildatas = Supplier_order::max('idpo');
            $ceks2 = (int)substr($ambildatas, 4) + 1;
            $get_idpo = $ceks2;
        }

        for ($i = 0; $i < count($size); $i++) {
            // End cek stock Variasi Aktif
            $get_var = variation::where('id_produk', $id_produk)
                ->where('id_ware', $warehouse_asal)
                ->where('size', $size[$i])
                ->where('qty', '!=', '0')
                ->orderBy('idpo', 'ASC')
                ->get();

            $qty_sales = $qty[$i];
            $count = 0;

            for ($b = 0; $b < count($get_var); $b++) {
                $get_qty = $get_var[$b]['qty'];
                $qty_baru = intval($get_qty) - intval($qty_sales);

                $get_modal = Supplier_order::where('idpo', $get_var[$b]['idpo'])
                    ->where('id_produk', $id_produk)
                    ->get('m_price');

                if ($b === 0) {
                    $validation =  $get_var[$b]['idpo'];
                } else {
                    $validation =  $get_var[$b - 1]['idpo'];
                }

                if ($get_var[$b]['idpo'] === $validation) {
                    $get_idpos = $get_idpo;
                } else {
                    $count = $count + 1;
                    $get_idpos = $get_idpo + $count;
                }

                $cek_idpo = Supplier_order::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                    ->where('id_produk', $id_produk)
                    ->where('id_sup', $get_var[$b]['idpo'] . '#' . $warehouse_asal)
                    ->get();

                if ($qty_baru >= 0) {
                    if (count($cek_idpo) > 0) {
                        $get_qty_old = $cek_idpo[0]['qty'];
                        // Update Supp QTY
                        Supplier_order::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_produk', $id_produk)
                            ->where('id_sup', $get_var[$b]['idpo'] . '#' . $warehouse_asal)
                            ->update([
                                'qty' => $get_qty_old + $qty_sales,
                                'subtotal' => intval($cek_idpo[0]['subtotal']) + intval($qty_sales * $get_modal[0]['m_price']),
                            ]);
                        // Update Supp QTY
                    } else {
                        $save_po = new Supplier_order();
                        $save_po->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_po->id_sup = $get_var[$b]['idpo'] . '#' . $warehouse_asal;
                        $save_po->id_produk = $id_produk;
                        $save_po->id_ware = $warehouse_tujuan;
                        $save_po->brand = $brand;
                        $save_po->tanggal = $tanggalskrg;
                        $save_po->produk = $produk;
                        $save_po->qty = $qty_sales;
                        $save_po->m_price = $get_modal[0]['m_price'];
                        $save_po->subtotal = $qty_sales * $get_modal[0]['m_price'];
                        $save_po->tipe_order = 'TRANSFER';
                        $save_po->users = $getuser;
                        $save_po->save();
                    }

                    $cek_size = variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                        ->where('id_produk', $id_produk)
                        ->where('size', $size[$i])
                        ->get();

                    if (count($cek_size) > 0) {
                        // Update Variation QTY
                        variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_ware', $warehouse_tujuan)
                            ->where('size', $size[$i])
                            ->where('id_produk', $id_produk)
                            ->update([
                                'qty' => $cek_size[0]['qty'] + $qty_sales,
                            ]);
                        // QTY Update Variation QTY
                    } else {
                        $save_var = new variation();
                        $save_var->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_var->tanggal = $tanggalskrg;
                        $save_var->id_produk = $id_produk;
                        $save_var->id_area = $id_area;
                        $save_var->id_ware = $warehouse_tujuan;
                        $save_var->size = $size[$i];
                        $save_var->qty = $qty_sales;
                        $save_var->users = $getuser;
                        $save_var->save();
                    }

                    $cek_size_var = Supplier_variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                        ->where('id_produk', $id_produk)
                        ->where('size', $size[$i])
                        ->get();

                    if (count($cek_size_var) > 0) {
                        // Update Variation QTY
                        Supplier_variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_ware', $warehouse_tujuan)
                            ->where('size', $size[$i])
                            ->where('id_produk', $id_produk)
                            ->update([
                                'qty' => $cek_size_var[0]['qty'] + $qty_sales,
                            ]);
                        // QTY Update Variation QTY
                    } else {
                        $save_var = new Supplier_variation();
                        $save_var->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_var->tanggal = $tanggalskrg;
                        $save_var->id_produk = $id_produk;
                        $save_var->id_area = $id_area;
                        $save_var->id_ware = $warehouse_tujuan;
                        $save_var->size = $size[$i];
                        $save_var->qty = $qty_sales;
                        $save_var->users = $getuser;
                        $save_var->id_sup = $get_var[$b]['idpo'] . '#' . $warehouse_asal;
                        $save_var->tipe_order = 'TRANSFER';
                        $save_var->save();
                    }

                    $get_old_po = Supplier_order::where('idpo', $get_var[$b]['idpo'])
                        ->where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->get();

                    Supplier_order::where('idpo', $get_var[$b]['idpo'])
                        ->where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->update([
                            'qty' => $get_old_po[0]['qty'] - $qty_sales,
                            'subtotal' => intval($get_old_po[0]['qty'] - $qty_sales) * intval($get_old_po[0]['m_price']),
                        ]);


                    // Update Variation QTY
                    variation::where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->where('size', $get_var[$b]['size'])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_baru,
                        ]);
                    // QTY Update Variation QTY

                    // Update Variation Pasif
                    Supplier_variation::where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->where('size', $get_var[$b]['size'])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_baru,
                        ]);
                    // QTY Update Variation Pasif
                    break;
                } else {
                    if ($qty_baru < 0) {
                        $qty_sisa = 0;
                    }

                    if (count($cek_idpo) > 0) {
                        $get_qty_old = $cek_idpo[0]['qty'];
                        // Update Supp QTY
                        Supplier_order::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_produk', $id_produk)
                            ->where('id_sup', $get_var[$b]['idpo'] . '#' . $warehouse_asal)
                            ->update([
                                'qty' => $get_qty_old + $get_var[$b]['qty'],
                                'subtotal' => intval($cek_idpo[0]['subtotal']) + intval($get_var[$b]['qty'] * $get_modal[0]['m_price']),
                            ]);
                        // Update Supp QTY
                    } else {
                        $save_po = new Supplier_order();
                        $save_po->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_po->id_sup = $get_var[$b]['idpo'] . '#' . $warehouse_asal;
                        $save_po->id_produk = $id_produk;
                        $save_po->id_ware = $warehouse_tujuan;
                        $save_po->brand = $brand;
                        $save_po->tanggal = $tanggalskrg;
                        $save_po->produk = $produk;
                        $save_po->qty = $get_var[$b]['qty'];
                        $save_po->m_price = $get_modal[0]['m_price'];
                        $save_po->subtotal = $get_var[$b]['qty'] * $get_modal[0]['m_price'];
                        $save_po->tipe_order = 'TRANSFER';
                        $save_po->users = $getuser;
                        $save_po->save();
                    }

                    $cek_size = variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                        ->where('id_produk', $id_produk)
                        ->where('size', $size[$i])
                        ->get();

                    if (count($cek_size) > 0) {
                        // Update Variation QTY
                        variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_ware', $warehouse_tujuan)
                            ->where('size', $size[$i])
                            ->where('id_produk', $id_produk)
                            ->update([
                                'qty' => $cek_size[0]['qty'] + $get_var[$b]['qty'],
                            ]);
                        // QTY Update Variation QTY
                    } else {
                        $save_var = new variation();
                        $save_var->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_var->tanggal = $tanggalskrg;
                        $save_var->id_produk = $id_produk;
                        $save_var->id_area = $id_area;
                        $save_var->id_ware = $warehouse_tujuan;
                        $save_var->size = $size[$i];
                        $save_var->qty = $get_var[$b]['qty'];
                        $save_var->users = $getuser;
                        $save_var->save();
                    }

                    $cek_size_var = Supplier_variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                        ->where('id_produk', $id_produk)
                        ->where('size', $size[$i])
                        ->get();

                    if (count($cek_size_var) > 0) {
                        // Update Variation QTY
                        Supplier_variation::where('idpo', $thn_bln . sprintf("%04s", + ($get_idpos)))
                            ->where('id_ware', $warehouse_tujuan)
                            ->where('size', $size[$i])
                            ->where('id_produk', $id_produk)
                            ->update([
                                'qty' => $cek_size_var[0]['qty'] + $get_var[$b]['qty'],
                            ]);
                        // QTY Update Variation QTY
                    } else {
                        $save_var = new Supplier_variation();
                        $save_var->idpo = $thn_bln . sprintf("%04s", + ($get_idpos));
                        $save_var->tanggal = $tanggalskrg;
                        $save_var->id_produk = $id_produk;
                        $save_var->id_area = $id_area;
                        $save_var->id_ware = $warehouse_tujuan;
                        $save_var->size = $size[$i];
                        $save_var->qty = $get_var[$b]['qty'];
                        $save_var->users = $getuser;
                        $save_var->id_sup = $get_var[$b]['idpo'] . '#' . $warehouse_asal;
                        $save_var->tipe_order = 'TRANSFER';
                        $save_var->save();
                    }

                    $get_old_po = Supplier_order::where('idpo', $get_var[$b]['idpo'])
                        ->where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->get();

                    Supplier_order::where('idpo', $get_var[$b]['idpo'])
                        ->where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->update([
                            'qty' => $get_old_po[0]['qty'] - $get_var[$b]['qty'],
                            'subtotal' => intval($get_old_po[0]['qty'] - $get_var[$b]['qty']) * intval($get_old_po[0]['m_price']),
                        ]);


                    // Update Variation QTY
                    variation::where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->where('size', $get_var[$b]['size'])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_sisa,
                        ]);
                    // QTY Update Variation QTY

                    // Update Variation Pasif
                    Supplier_variation::where('id_produk', $id_produk)
                        ->where('id_ware', $warehouse_asal)
                        ->where('size', $get_var[$b]['size'])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_sisa,
                        ]);
                    // QTY Update Variation Pasif

                    $qty_sales = intval($qty_sales) - intval($get_qty);
                }
            }
            // End cek stock Variasi Aktif
        }
        return redirect('/productTransfer/productTransfers');
    }
}
