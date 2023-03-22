<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\Displays;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Image_product;
use App\Models\Store;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\warehouse;
use App\Models\variation;
use App\Models\Supplier_order;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sale()
    {
        $title = "SALES";

        $getstore = Store::with('detailsarea')->get();
        $getkasir = Employee::all()->where('role', '!=', 'ADMIN');
        $getreseller = Reseller::all();
        // $getreseller = Reseller::all();

        return view('sale.sales', compact(
            'title',
            'getstore',
            'getkasir',
            'getreseller'
        ));
    }

    public function tablesale(Request $request)
    {
        if ($request->ajax()) {
            $id_area = $request->area;
            $querys = $request->querys;

            if ($querys == '') {
                $data = Product::with('warehouse', 'image_product', 'product_variation')
                    ->where('products.id_area', $id_area)
                    ->groupBy('products.id_produk')
                    ->paginate(6);
            } else {
                $data = Product::with('warehouse', 'image_product', 'product_variation')
                    ->where('products.id_area', $id_area)
                    ->where('products.produk', 'LIKE', '%' . $querys . '%')
                    ->orwhere('products.id_produk', 'LIKE', '%' . $querys . '%')
                    ->groupBy('products.id_produk')
                    ->paginate(6);
            }


            return view('load.load_catalog', compact(
                'data'
            ));
        }
    }

    public function load_size(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $size = $request->size;
            $store = $request->store;

            $display = Displays::where('id_store', $store)
                ->where('id_produk', $id_produk)
                ->where('id_ware', $id_ware)
                ->get();

            if ($size === 'allsize') {
                $data = DB::table('variations')
                    ->selectRaw('SUM(qty) as qty,id,size')
                    ->where('id_produk', $id_produk)
                    ->where('id_ware', $id_ware)
                    ->groupBy('size')
                    ->get();
                $count = count($data);
            } else {
                $data = DB::table('variations')
                    ->selectRaw('SUM(qty) as qty,id,size')
                    ->where('id_produk', $id_produk)
                    ->where('id_ware', $id_ware)
                    ->where('size', $size)
                    ->groupBy('size')
                    ->get();
                $count = count($data);
            }

            return view('load.load_modal_catalog', compact(
                'data',
                'count',
                'display'
            ));
        }
    }

    public function getbarcodeproduct(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $size = $request->size;

            $get = Product::with('warehouse', 'image_product', 'product_variation')
                ->where('products.id_produk', $id_produk)
                ->groupBy('products.id_produk')
                ->get();

            $count = count($get);

            if ($count > 0) {
                if ($get[0]->image_product[0]['img'] == '') {
                    $image_product = 'defaultimg.png';
                } else {
                    $image_product = $get[0]->image_product[0]['img'];
                }

                $data = array(
                    "produk" => $get[0]['produk'],
                    "id_produk" => $get[0]['id_produk'],
                    "brand" => $get[0]['brand'],
                    "quality" => $get[0]['quality'],
                    "img_produk" => $image_product,
                    "n_price" => $get[0]['n_price'],
                    "r_price" => $get[0]['r_price'],
                    "g_price" => $get[0]['g_price'],
                    "count" => $count,
                );

                echo json_encode($data);
            } else {
                $data = array(
                    "count" => $count,
                );

                echo json_encode($data);
            }
        }
    }

    public function load_ware(Request $request)
    {
        if ($request->ajax()) {
            $id_area = $request->id_area;

            $data = DB::table('warehouses')->where('id_area', $id_area)->get();

            return view('load.load_warehouse', compact(
                'data'
            ));
        }
    }

    public function save_sales(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        $thn_bln_tgl = $now->format('ymd');
        // $hitung = Sale::where('tanggal', $today)->where('id_invoice', 'not like', '%P%')->groupBy('id_invoice')->get();
        DB::beginTransaction();
        $hitung = Sale::where('tanggal', $today)->groupBy('id_invoice')->lockForUpdate()->get();
        if (count($hitung) === 0) {
            $urut3 = 1;
            $idinvoice = $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            // $ambildatas2 = Sale::sharedLock()->where('tanggal', $today)->where('id_invoice', 'not like', '%P%')->get()->max('id_invoice');
            $ambildatas2 = Sale::where('tanggal', $today)->lockForUpdate()->get()->max('id_invoice');
            $replace = str_replace(str_split('PA-'), '', $ambildatas2);
            $hitung2 = (int)substr($replace, -4) + 1;
            $idinvoice = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }

        $tanggal = $request->r_tanggal;
        $warehouse = $request->r_idware;
        $id_area = $request->r_area;
        $store = $request->r_id_store;
        $customer = $request->customer;
        $quality = $request->r_quality;
        $produk = $request->r_produk;
        $size = $request->r_size;
        $qty = $request->r_qty;
        $selling_price = $request->r_selling_price;
        $discitem = $request->r_diskon_item;
        $subtotal = $request->r_subtotal;
        $cashier = $request->cashier;
        $idbrand = $request->r_id_brand;
        $idproduk = $request->r_id_produk;

        $cash = $request->r_cash;
        $bca = $request->r_bca;
        $mandiri = $request->r_mandiri;
        $banktf = $request->r_banktf;

        $payment = $request->r_payment_method;

        if ($payment === "PENDING") {
            $discnota = 0;
            $ongkir = 0;
            $grandtotal = $request->r_grandtotal;
        } else {
            $discnota = $request->rs_discnota;
            $ongkir = $request->rs_ongkir;
            $grandtotal = intval($request->r_grandtotal) - intval($request->rs_ongkir);
        }


        if ($request->reseller_name === null) {
            $reseller_name = '-';
        } else {
            $reseller_name = $request->reseller_name;
        }

        if ($cash === null) {
            $cash = '0';
        } else {
            $cash = preg_replace("/[^0-9]/", "", $request->r_cash);
        }

        if ($bca === null) {
            $bca = '0';
        } else {
            $bca = preg_replace("/[^0-9]/", "", $request->r_bca);
        }

        if ($mandiri === null) {
            $mandiri = '0';
        } else {
            $mandiri = preg_replace("/[^0-9]/", "", $request->r_mandiri);
        }

        if ($banktf === null) {
            $banktf = '0';
        } else {
            $banktf = preg_replace("/[^0-9]/", "", $request->r_banktf);
        }

        $display = $request->r_display;
        $count = $request->count;

        for ($i = 0; $i < $count; $i++) {
            // DB::beginTransaction();

            if ($display[$i] === 'display') {
                Displays::where('id_store', $store)
                    ->where('id_ware', $warehouse[$i])
                    ->where('id_produk', $idproduk[$i])
                    ->delete();
            }

            // cek stock Variasi Aktif
            $get_var = variation::where('id_produk', $idproduk[$i])
                ->where('id_area', $id_area)
                ->where('id_ware', $warehouse[$i])
                ->where('size', $size[$i])
                ->where('qty', '>', '0')  // disini indikasi error
                ->orderBy('idpo', 'ASC')
                ->get();

            $qty_sales = $qty[$i];

            for ($b = 0; $b < count($get_var); $b++) {
                $get_qty = $get_var[$b]['qty'];
                $qty_baru = intval($get_qty) - intval($qty_sales);

                $get_modal = Supplier_order::where('idpo', $get_var[$b]['idpo'])
                    ->where('id_produk', $idproduk[$i])
                    ->get('m_price');

                    $diskonitemsatuan = intVal($discitem[$i]) / intVal($qty[$i]) ;
                    $subtotalsatuan = intVal($subtotal[$i]) / intVal($qty[$i]) ;

                if ($qty_baru >= 0) {
                    // print_r("QTY Lama".$get_qty."<br>");
                    // print_r("QTY Penjualan".$qty_sales."<br>");
                    // print_r("QTY Baru".$qty_baru."<br>");
                    // print_r("QTY Baru".$get_var[$b]['idpo']."<br>");
                    // print_r("While Selesai"."<br><br>");
                    // Save Function
                    $data = new Sale();
                    $data->m_price = $get_modal[0]['m_price'];
                    $data->tanggal = $tanggal;
                    $data->id_invoice = $idinvoice;
                    $data->id_produk = $idproduk[$i];
                    $data->idpo = $get_var[$b]['idpo'];
                    $data->id_area = $id_area;
                    $data->id_ware = $warehouse[$i];
                    $data->id_store = $store;
                    $data->id_brand = $idbrand[$i];
                    $data->id_reseller = $reseller_name;
                    $data->payment = $payment;
                    $data->customer = $customer;
                    $data->quality = $quality[$i];
                    $data->produk = $produk[$i];
                    $data->size = $size[$i];
                    $data->qty = $qty_sales;
                    $data->selling_price = $selling_price[$i];
                    $data->diskon_item = $diskonitemsatuan * $qty_sales ;
                    $data->diskon_all = $discnota;
                    $data->subtotal =  $subtotalsatuan * $qty_sales ;
                    $data->grandtotal = $grandtotal;
                    $data->cash = $cash;
                    $data->bca = $bca;
                    $data->mandiri = $mandiri;
                    $data->qris = $banktf;
                    $data->ongkir = $ongkir;
                    $data->refund = '0';
                    $data->users = $cashier;
                    $data->save();
                    // End Save Function

                    // Update Variation QTY
                    variation::where('id_produk', $idproduk[$i])
                        ->where('id_area', $id_area)
                        ->where('id_ware', $warehouse[$i])
                        ->where('size', $size[$i])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_baru,
                        ]);
                    // QTY Update Variation QTY
                    break;
                } else {
                    if ($qty_baru < 0) {
                        $qty_sisa = 0;
                    }
                    // print_r("QTY Lama".$get_qty."<br>");
                    // print_r("QTY Penjualans".$qty_sales."<br>");
                    // print_r("QTY Baru".$qty_baru."<br>");
                    // print_r("QTY Baru".$get_var[$b]['idpo']."<br>");
                    // print_r("While Lanjut"."<br><br>");
                    // Save Function
                    $data = new Sale();
                    $data->m_price = $get_modal[0]['m_price'];
                    $data->tanggal = $tanggal;
                    $data->id_invoice = $idinvoice;
                    $data->id_produk = $idproduk[$i];
                    $data->idpo = $get_var[$b]['idpo'];
                    $data->id_area = $id_area;
                    $data->id_ware = $warehouse[$i];
                    $data->id_store = $store;
                    $data->id_brand = $idbrand[$i];
                    $data->id_reseller = $reseller_name;
                    $data->payment = $payment;
                    $data->customer = $customer;
                    $data->quality = $quality[$i];
                    $data->produk = $produk[$i];
                    $data->size = $size[$i];
                    $data->qty = $get_qty;
                    $data->selling_price = $selling_price[$i];
                    $data->diskon_item = $diskonitemsatuan * $get_qty;
                    $data->diskon_all = $discnota;
                    $data->subtotal = $subtotalsatuan * $get_qty;
                    $data->grandtotal = $grandtotal;
                    $data->cash = $cash;
                    $data->bca = $bca;
                    $data->mandiri = $mandiri;
                    $data->qris = $banktf;
                    $data->ongkir = $ongkir;
                    $data->refund = '0';
                    $data->users = $cashier;
                    $data->save();
                    // End Save Function

                    // Update Variation QTY
                    variation::where('id_produk', $idproduk[$i])
                        ->where('id_area', $id_area)
                        ->where('id_ware', $warehouse[$i])
                        ->where('size', $size[$i])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->update([
                            'qty' => $qty_sisa,
                        ]);
                    // QTY Update Variation QTY

                    $qty_sales = intval($qty_sales) - intval($get_qty);
                }
            }
            // End cek stock Variasi Aktif
            DB::commit();
        }

        DB::commit();

        // print_r($ambildatas2);
        // print_r('<br>');
        // print_r($replace);
        // print_r('<br>');
        // print_r($idinvoice);

        echo '<script>window.open("/print_sales/' . $idinvoice . '","_blank")</script>';
        echo '<script>window.location.href="/sale/sales"</script>';

        return redirect('/sale/sales');
    }

    public function redirect_print()
    {

        // return redirect('https://www.google.com');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function print_sales(Request $request, $id_invoice)
    {
        $product = Product::with('store', 'image_product', 'display')->groupBy('id_produk')->get();

        $details = Sale::with('store_inv')->selectRaw('*,SUM(qty) as qty, SUM(subtotal) as subtotal')->where('id_invoice', $id_invoice)->groupBy('id_invoice', 'id_produk', 'size')->get();
        $ammount = Sale::selectRaw('SUM(qty) as qty')->where('id_invoice', $id_invoice)->get();
        $grandtotal = Sale::where('id_invoice', $id_invoice)->groupBy('id_invoice')->get();

        $data = [
            'details' => $details,
            'ammount' => $ammount,
            'grandtotal' => $grandtotal,
        ];

        $pdf = MPDF::loadView(
            'sale.print_sales',
            $data,
            [],
            [
                'format' => 'a4',
                'orientation' => 'P',
                'margin_left' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]
        );
        ob_get_clean();
        return $pdf->stream('document.pdf');
    }
}
