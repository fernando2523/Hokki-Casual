<?php

namespace App\Http\Controllers\orderPaid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\variation;
use App\Models\Store_equipment_cost;
use App\Models\Cancel_order;
use App\Models\Return_order;
use App\Models\Supplier_order;
use App\Models\Store;

class OrderPaidController extends Controller
{
    public function order_paids()
    {
        $title = "Order Reseller Paid";
        $store = Store::all();

        return view('orderPaid/order_paids', compact(
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
            $nota = Sale::selectRaw('count(DISTINCT id_invoice) as id_invoice')->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->get('id_invoice');
            $qty = Sale::whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->sum('qty');
            $ongkir = Sale::selectRaw('ongkir')->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->groupBy('id_invoice')->get();
            $gross_sale = Sale::whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->get();
            $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->sum('total_price');
            $discount_item = Sale::whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->sum('diskon_item');
            $discount_all = Sale::selectRaw('diskon_all')->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->groupBy('id_invoice')->get('diskon_all');
        } else {
            $nota = Sale::selectRaw('count(DISTINCT id_invoice) as id_invoice')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->get('id_invoice');
            $qty = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->where('customer', 'RESELLER')->where('payment', 'PAID')->sum('qty');
            $ongkir = Sale::selectRaw('ongkir')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->groupBy('id_invoice')->get();
            $gross_sale = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->where('customer', 'RESELLER')->where('payment', 'PAID')->get();
            $expenses = Store_equipment_cost::whereBetween('tanggal', [$start, $end])->where('store', $store)->sum('total_price');
            $discount_item = Sale::whereBetween('tanggal', [$start, $end])->where('id_store', $store)->where('customer', 'RESELLER')->where('payment', 'PAID')->sum('diskon_item');
            $discount_all = Sale::selectRaw('diskon_all')->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->where('customer', 'RESELLER')->where('payment', 'PAID')->groupBy('id_invoice')->get('diskon_all');
        }

        return view('orderPaid.load_headerorder', compact(
            'nota',
            'qty',
            'ongkir',
            'gross_sale',
            'expenses',
            'discount_item',
            'discount_all'
        ));
    }

    public function load_tborders_paid(Request $request)
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
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->whereBetween('tanggal', [$start, $end])
                        ->where('customer', 'RESELLER')
                        ->where('payment', 'PAID')
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                        ->where([['id_invoice', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['produk',  'Like', '%' . $querys_result . '%'], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_produk',  $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['users', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_reseller', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])

                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys_result == '') {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->whereBetween('tanggal', [$start, $end])
                        ->where('customer', 'RESELLER')
                        ->where('payment', 'PAID')
                        ->where('id_invoice', '<', $last_id)

                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where([['id_invoice', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%'], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_produk', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_invoice', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['users', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_reseller', $querys_result], ['customer', 'RESELLER'], ['payment', 'PAID']])

                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            }
        } else {
            if ($last_id == '0') {
                if ($querys_result == '') {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('customer', 'RESELLER')
                        ->where('payment', 'PAID')
                        ->where('id_store', $store)
                        ->whereBetween('tanggal', [$start, $end])
                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                        ->where([['id_invoice', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['produk',  'Like', '%' . $querys_result . '%'], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_produk',  $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['users', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_reseller', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])

                        ->orderBy('id_invoice', 'DESC')
                        ->groupBy('id_invoice')
                        ->limit(10)
                        ->get();
                }
            } else {
                if ($querys_result == '') {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                        ->where('customer', 'RESELLER')
                        ->where('payment', 'PAID')
                        ->where('id_store', $store)
                        ->whereBetween('tanggal', [$start, $end])
                        ->where('id_invoice', '<', $last_id)

                        ->groupBy('id_invoice')
                        ->orderBy('id_invoice', 'DESC')
                        ->limit(10)
                        ->get();
                } else {
                    $data = Sale::with('details', 'store', 'reseller')
                        ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                        ->where([['id_invoice', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%'], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_produk', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_invoice', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['users', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])
                        ->orwhere([['id_invoice', '<', $last_id], ['id_reseller', $querys_result], ['id_store', $store], ['customer', 'RESELLER'], ['payment', 'PAID']])

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
            return view('orderPaid.load_tborder_paid', compact(
                'store',
                'start',
                'end',
                'data',
                'count',
                'current_page'
            ));
        }
    }

    public function cancel_order_paid(Request $request)
    {
        $id_invoice = $request->id_invoice;

        $get_id_invoice = Sale::where('id_invoice', $id_invoice)->get();

        $now = Carbon::now('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        $thn_bln_tgl = $now->format('ymd');
        $hitung = Cancel_order::sharedLock()->where('tanggal', $today)->where('tipe_refund', "CANCEL")->groupBy('id_transaction')->get();
        if (count($hitung) === 0) {
            $urut3 = 1;
            $id_transaction = "CANCEL-" . $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Cancel_order::sharedLock()->where('tanggal', $today)->where('tipe_refund', "CANCEL")->get()->max('id_transaction');
            $hitung2 = (int)substr($ambildatas2, -4) + 1;
            $id_transaction = "CANCEL-" . $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }

        foreach ($get_id_invoice as $data) {
            // Convert To Cancel Order
            $datas = new Cancel_order();
            $datas->tanggal = $data->tanggal;
            $datas->id_transaction = $id_transaction;
            $datas->tipe_refund = 'CANCEL';
            $datas->customer = $data->customer;
            $datas->id_invoice = $data->id_invoice;
            $datas->idpo = $data->idpo;
            $datas->id_produk = $data->id_produk;
            $datas->id_ware = $data->id_ware;
            $datas->id_area = $data->id_area;
            $datas->id_store = $data->id_store;
            $datas->id_brand = $data->id_brand;
            $datas->id_reseller = $data->id_reseller;
            $datas->payment = $data->payment;
            $datas->produk = $data->produk;
            $datas->size = $data->size;
            $datas->qty = $data->qty;
            $datas->quality = $data->quality;
            $datas->m_price = $data->m_price;
            $datas->selling_price = $data->selling_price;
            $datas->diskon_item = $data->diskon_item;
            $datas->diskon_all = $data->diskon_all;
            $datas->subtotal = $data->subtotal;
            $datas->grandtotal = $data->grandtotal;
            $datas->cash = $data->cash;
            $datas->bca = $data->bca;
            $datas->mandiri = $data->mandiri;
            $datas->qris = $data->qris;
            $datas->ongkir = $data->ongkir;
            $datas->refund = $data->refund;
            $datas->desc = '';
            $datas->users = Auth::user()->name;
            $datas->save();
            // Convert To Cancel Order

            // Variations
            $old_qty = variation::where('id_produk', $data->id_produk)
                ->where('idpo', $data->idpo)
                ->where('id_ware', $data->id_ware)
                ->where('size', $data->size)
                ->get('qty');

            $qty_new = intval($old_qty[0]['qty']) + intval($data->qty);

            variation::where('id_produk', $data->id_produk)
                ->where('idpo', $data->idpo)
                ->where('id_ware', $data->id_ware)
                ->where('size', $data->size)
                ->update([
                    'qty' => $qty_new,
                ]);
            // Variations

            // Delete Id_Invoice
            Sale::where('id', $data->id)->delete();
            // Delete Id_Invoice
        }

        return redirect('orderPaid/order_paids');
    }

    public function load_refund_paid(Request $request)
    {
        $id_invoice = $request->id_invoice;
        $count = $request->count;
        $data = Sale::where('id_invoice', $id_invoice)->get();

        return view('orderPaid.load_refund_paid', compact(
            'id_invoice',
            'count',
            'data'
        ));
    }

    public function load_retur_paid(Request $request)
    {
        $id_invoice = $request->id_invoice;
        $count = $request->count;
        $data = Sale::where('id_invoice', $id_invoice)->get();

        return view('orderPaid.load_retur_paid', compact(
            'id_invoice',
            'count',
            'data'
        ));
    }

    public function cek_size_retur_paid(Request $request)
    {
        $gudang = $request->gudang;
        $id = $request->id;

        $get_produk = Sale::where('id', $id)->get();

        $get_var = variation::selectRaw('*,SUM(qty) as qty')
            ->where('id_produk', $get_produk[0]['id_produk'])
            ->where('id_area', $get_produk[0]['id_area'])
            ->where('id_ware', $gudang)
            ->where('size', '!=', $get_produk[0]['size'])
            ->where('qty', '!=', '0')
            ->groupBy('size')
            ->get();

        $result = '';
        foreach ($get_var as $data) {
            $result .= '<option data-max="' . $data->qty . '" value="' . $data->size . '">' . $data->size . '=' . $data->qty . '</option>';
        }

        echo $result;
    }

    public function get_warehouse_paid(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $id = $request->id;

        $get_produk = Sale::where('id', $id)->get();

        $get_var = variation::with('warehouse')
            ->where('id_produk', $get_produk[0]['id_produk'])
            ->where('id_area', $get_produk[0]['id_area'])
            ->groupBy('id_ware')
            ->get();

        $result = '';
        foreach ($get_var as $data) {
            $result .= '<option value="' . $data->id_ware . '">' . $data->warehouse[0]['warehouse'] . '</option>';
        }

        echo $result;
    }

    public function refund_order_paid(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $count = $request->r_count;
        $id = $request->r_produk;
        $qty = $request->r_qty;
        $ket = $request->ket;

        $grand_total = 0;
        $total_refund = 0;

        $now = Carbon::now('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        $thn_bln_tgl = $now->format('ymd');
        $hitung = Cancel_order::sharedLock()->where('tanggal', $today)->where('tipe_refund', "REFUND")->groupBy('id_transaction')->get();
        if (count($hitung) === 0) {
            $urut3 = 1;
            $id_transaction = "REFUND-" . $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Cancel_order::sharedLock()->where('tanggal', $today)->where('tipe_refund', "REFUND")->get()->max('id_transaction');
            $hitung2 = (int)substr($ambildatas2, -4) + 1;
            $id_transaction = "REFUND-" . $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }

        for ($i = 0; $i < count($id); $i++) {
            DB::beginTransaction();

            $produk = Sale::where('id', $id[$i])->get();
            $result = intval($produk[0]['qty']) - intval($qty[$i]);

            $old_qty = variation::where('id_produk', $produk[0]['id_produk'])
                ->where('idpo', $produk[0]['idpo'])
                ->where('id_ware', $produk[0]['id_ware'])
                ->where('size', $produk[0]['size'])
                ->get('qty');

            $qty_baru = intval($old_qty[0]['qty']) + intval($qty[$i]);

            $disc_item = $produk[0]['diskon_item'] / $produk[0]['qty'];

            if ($result === 0) {
                variation::where('id_produk', $produk[0]['id_produk'])
                    ->where('idpo', $produk[0]['idpo'])
                    ->where('id_ware', $produk[0]['id_ware'])
                    ->where('size', $produk[0]['size'])
                    ->update([
                        'qty' => $qty_baru,
                    ]);

                // Convert To Cancel Order
                $datas = new Cancel_order();
                $datas->tanggal = $produk[0]['tanggal'];
                $datas->id_transaction = $id_transaction;
                $datas->tipe_refund = 'REFUND';
                $datas->customer = $produk[0]['customer'];
                $datas->id_invoice = $produk[0]['id_invoice'];
                $datas->idpo = $produk[0]['idpo'];
                $datas->id_produk = $produk[0]['id_produk'];
                $datas->id_ware = $produk[0]['id_ware'];
                $datas->id_area = $produk[0]['id_area'];
                $datas->id_store = $produk[0]['id_store'];
                $datas->id_brand = $produk[0]['id_brand'];
                $datas->id_reseller = $produk[0]['id_reseller'];
                $datas->payment = $produk[0]['payment'];
                $datas->produk = $produk[0]['produk'];
                $datas->size = $produk[0]['size'];
                $datas->qty = $qty[$i];
                $datas->quality = $produk[0]['quality'];
                $datas->m_price = $produk[0]['m_price'];
                $datas->selling_price = $produk[0]['selling_price'];
                $datas->diskon_item = $disc_item * $qty[$i];
                $datas->diskon_all = 0;
                $datas->subtotal = ($produk[0]['selling_price'] * $qty[$i]) - ($disc_item * $qty[$i]);
                $datas->grandtotal = 0;
                $datas->cash = 0;
                $datas->bca = 0;
                $datas->mandiri = 0;
                $datas->qris = 0;
                $datas->ongkir = $produk[0]['ongkir'];
                $datas->refund = 0;
                $datas->desc = $ket;
                $datas->users = Auth::user()->name;
                $datas->save();
                // Convert To Cancel Order

                Sale::where('id', $id[$i])->delete();
            } else {
                variation::where('id_produk', $produk[0]['id_produk'])
                    ->where('idpo', $produk[0]['idpo'])
                    ->where('id_ware', $produk[0]['id_ware'])
                    ->where('size', $produk[0]['size'])
                    ->update([
                        'qty' => $qty_baru,
                    ]);

                // Convert To Cancel Order
                $datas = new Cancel_order();
                $datas->tanggal = $produk[0]['tanggal'];
                $datas->id_transaction = $id_transaction;
                $datas->tipe_refund = 'REFUND';
                $datas->customer = $produk[0]['customer'];
                $datas->id_invoice = $produk[0]['id_invoice'];
                $datas->idpo = $produk[0]['idpo'];
                $datas->id_produk = $produk[0]['id_produk'];
                $datas->id_ware = $produk[0]['id_ware'];
                $datas->id_area = $produk[0]['id_area'];
                $datas->id_store = $produk[0]['id_store'];
                $datas->id_brand = $produk[0]['id_brand'];
                $datas->id_reseller = $produk[0]['id_reseller'];
                $datas->payment = $produk[0]['payment'];
                $datas->produk = $produk[0]['produk'];
                $datas->size = $produk[0]['size'];
                $datas->qty = $qty[$i];
                $datas->quality = $produk[0]['quality'];
                $datas->m_price = $produk[0]['m_price'];
                $datas->selling_price = $produk[0]['selling_price'];
                $datas->diskon_item = $disc_item * $qty[$i];
                $datas->diskon_all = 0;
                $datas->subtotal = ($produk[0]['selling_price'] * $qty[$i]) - ($disc_item * $qty[$i]);
                $datas->grandtotal = 0;
                $datas->cash = 0;
                $datas->bca = 0;
                $datas->mandiri = 0;
                $datas->qris = 0;
                $datas->ongkir = $produk[0]['ongkir'];
                $datas->refund = 0;
                $datas->desc = $ket;
                $datas->users = Auth::user()->name;
                $datas->save();
                // Convert To Cancel Order

                Sale::where('id', $id[$i])
                    ->update([
                        'qty' => $result,
                        'diskon_item' => $disc_item * $result,
                        'subtotal' => ($produk[0]['selling_price'] * $result) - ($disc_item * $result),
                    ]);
            }
            $result_refund = ($produk[0]['selling_price'] * $qty[$i]) - ($disc_item * $qty[$i]);
            $total_refund = intval($total_refund) +  intval($result_refund);
            DB::commit();
        }

        Sale::where('id_invoice', $id_invoice)
            ->update([
                'grandtotal' => intval($produk[0]['grandtotal']) - intval($total_refund),
                'refund' => $total_refund,
            ]);

        Cancel_order::where('id_invoice', $id_invoice)
            ->update([
                'grandtotal' => $total_refund,
                'refund' => $total_refund,
            ]);

        return redirect('orderPaid/order_paids');
    }

    public function retur_order_paid(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $count = $request->r_count;
        $id = $request->r_produk;
        $size_new = $request->r_size;
        $qty_new = $request->r_qty;
        $ware = $request->r_ware;
        $ket = $request->ket;

        $total_retur = 0;

        $now = Carbon::now('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        $thn_bln_tgl = $now->format('ymd');
        $hitung = Return_order::sharedLock()->where('tanggal', $today)->groupBy('id_transaction')->get();
        if (count($hitung) === 0) {
            $urut3 = 1;
            $id_transaction = "RETURN-" . $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Return_order::sharedLock()->where('tanggal', $today)->get()->max('id_transaction');
            $hitung2 = (int)substr($ambildatas2, -4) + 1;
            $id_transaction = "RETURN-" . $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }

        if ($qty_new === '0') {
        } else {
            for ($i = 0; $i < count($id); $i++) {
                DB::beginTransaction();
                $get_produk = Sale::where('id', '=', $id[$i])->get();

                $result_qty = $get_produk[0]['qty'] - $qty_new[$i];
                $disc_item = $get_produk[0]['diskon_item'] / $get_produk[0]['qty'];

                // Convert To Retur Order
                $datas = new Return_order();
                $datas->tanggal = $today;
                $datas->id_transaction = $id_transaction;
                $datas->customer = $get_produk[0]['customer'];
                $datas->id_invoice = $get_produk[0]['id_invoice'];
                $datas->idpo = $get_produk[0]['idpo'];
                $datas->id_produk = $get_produk[0]['id_produk'];
                $datas->id_ware = $get_produk[0]['id_ware'];
                $datas->id_area = $get_produk[0]['id_area'];
                $datas->id_store = $get_produk[0]['id_store'];
                $datas->id_brand = $get_produk[0]['id_brand'];
                $datas->id_reseller = $get_produk[0]['id_reseller'];
                $datas->payment = $get_produk[0]['payment'];
                $datas->produk = $get_produk[0]['produk'];
                $datas->size = $get_produk[0]['size'];
                $datas->qty = $get_produk[0]['qty'];
                $datas->size_new = $size_new[$i];
                $datas->qty_new = $qty_new[$i];
                $datas->quality = $get_produk[0]['quality'];
                $datas->m_price = $get_produk[0]['m_price'];
                $datas->selling_price = $get_produk[0]['selling_price'];
                $datas->diskon_item = $disc_item * $qty_new[$i];
                $datas->diskon_all = $get_produk[0]['diskon_all'];
                $datas->subtotal = ($get_produk[0]['selling_price'] * $qty_new[$i]) - ($disc_item * $qty_new[$i]);
                $datas->grandtotal = 0;
                $datas->cash = 0;
                $datas->bca = 0;
                $datas->mandiri = 0;
                $datas->qris = 0;
                $datas->ongkir = 0;
                $datas->refund = 0;
                $datas->desc = $ket;
                $datas->users = Auth::user()->name;
                $datas->save();
                // Convert To Retur Order

                $get_var = variation::where('id_produk', $get_produk[0]['id_produk'])
                    ->where('id_area', $get_produk[0]['id_area'])
                    ->where('id_ware', $ware[$i])
                    ->where('size', $size_new[$i])
                    ->where('qty', '!=', '0')
                    ->orderBy('idpo', 'ASC')
                    ->get();
                // cek stock Variasi Aktif
                $qty_sales = $qty_new[$i];

                for ($b = 0; $b < count($get_var); $b++) {
                    $get_qty = $get_var[$b]['qty'];
                    $qty_baru = intval($get_qty) - intval($qty_sales);

                    $get_modal = Supplier_order::where('idpo', $get_var[$b]['idpo'])
                        ->where('id_produk', $get_produk[0]['id_produk'])
                        ->get('m_price');

                    $cek_produk = Sale::where('id_invoice', $id_invoice)
                        ->where('id_produk', $get_produk[0]['id_produk'])
                        ->where('size', $size_new[$i])
                        ->where('id_ware', $ware[$i])
                        ->where('idpo', $get_var[$b]['idpo'])
                        ->get();

                    if ($qty_baru >= 0) {
                        $cek_produk = Sale::where('id_invoice', $id_invoice)
                            ->where('id_produk', $get_produk[0]['id_produk'])
                            ->where('size', $size_new[$i])
                            ->where('id_ware', $ware[$i])
                            ->where('idpo', $get_var[$b]['idpo'])
                            ->get();

                        if (count($cek_produk) > 0) {
                            Sale::where('id_invoice', $id_invoice)
                                ->where('id_produk', $get_produk[0]['id_produk'])
                                ->where('size', $size_new[$i])
                                ->update([
                                    'qty' => $cek_produk[0]['qty'] + $qty_new[$i],
                                    'subtotal' => $cek_produk[0]['subtotal'] + (intval($cek_produk[0]['selling_price'] * $qty_new[$i]) - intval($disc_item * $qty_new[$i])),
                                    'diskon_item' => $cek_produk[0]['diskon_item'] + ($disc_item * $qty_new[$i]),
                                ]);
                        } else {
                            // Save Function
                            $data = new Sale();
                            $data->m_price = $get_modal[0]['m_price'];
                            $data->tanggal = $get_produk[0]['tanggal'];
                            $data->id_invoice = $get_produk[0]['id_invoice'];
                            $data->id_produk = $get_produk[0]['id_produk'];
                            $data->idpo = $get_var[$b]['idpo'];
                            $data->id_area = $get_produk[0]['id_area'];
                            $data->id_ware = $ware[$i];
                            $data->id_store = $get_produk[0]['id_store'];
                            $data->id_brand = $get_produk[0]['id_brand'];
                            $data->id_reseller = $get_produk[0]['id_reseller'];
                            $data->payment = $get_produk[0]['payment'];
                            $data->customer = $get_produk[0]['customer'];
                            $data->quality = $get_produk[0]['quality'];
                            $data->produk = $get_produk[0]['produk'];
                            $data->size = $size_new[$i];
                            $data->qty = $qty_new[$i];
                            $data->selling_price = $get_produk[0]['selling_price'];
                            $data->diskon_item = $disc_item * $qty_new[$i];
                            $data->diskon_all = $get_produk[0]['diskon_all'];
                            $data->subtotal = intval($get_produk[0]['selling_price'] * $qty_new[$i]) - intval($disc_item * $qty_new[$i]);
                            $data->grandtotal = $get_produk[0]['grandtotal'];
                            $data->cash = $get_produk[0]['cash'];
                            $data->bca = $get_produk[0]['bca'];
                            $data->mandiri = $get_produk[0]['mandiri'];
                            $data->qris = $get_produk[0]['qris'];
                            $data->ongkir = $get_produk[0]['ongkir'];
                            $data->refund = $get_produk[0]['refund'];
                            $data->users = $get_produk[0]['users'];
                            $data->save();
                            // End Save Function
                        }


                        // Update Variation QTY
                        variation::where('id_produk', $get_produk[0]['id_produk'])
                            ->where('id_area', $get_produk[0]['id_area'])
                            ->where('id_ware', $ware[$i])
                            ->where('size', $size_new[$i])
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
                        $cek_produk = Sale::where('id_invoice', $id_invoice)
                            ->where('id_produk', $get_produk[0]['id_produk'])
                            ->where('size', $size_new[$i])
                            ->where('id_ware', $ware[$i])
                            ->where('idpo', $get_var[$b]['idpo'])
                            ->get();

                        if (count($cek_produk) > 0) {
                            Sale::where('id_invoice', $id_invoice)
                                ->where('id_produk', $get_produk[0]['id_produk'])
                                ->where('size', $size_new[$i])
                                ->update([
                                    'qty' => $cek_produk[0]['qty'] + $qty_new[$i],
                                    'subtotal' => $cek_produk[0]['subtotal'] + (intval($cek_produk[0]['selling_price'] * $qty_new[$i]) - intval($disc_item * $qty_new[$i])),
                                    'diskon_item' => $cek_produk[0]['diskon_item'] + ($disc_item * $qty_new[$i]),
                                ]);
                        } else {
                            // Save Function
                            $data = new Sale();
                            $data->m_price = $get_modal[0]['m_price'];
                            $data->tanggal = $get_produk[0]['tanggal'];
                            $data->id_invoice = $get_produk[0]['id_invoice'];
                            $data->id_produk = $get_produk[0]['id_produk'];
                            $data->idpo = $get_var[$b]['idpo'];
                            $data->id_area = $get_produk[0]['id_area'];
                            $data->id_ware = $ware[$i];
                            $data->id_store = $get_produk[0]['id_store'];
                            $data->id_brand = $get_produk[0]['id_brand'];
                            $data->id_reseller = $get_produk[0]['id_reseller'];
                            $data->payment = $get_produk[0]['payment'];
                            $data->customer = $get_produk[0]['customer'];
                            $data->quality = $get_produk[0]['quality'];
                            $data->produk = $get_produk[0]['produk'];
                            $data->size = $size_new[$i];
                            $data->qty = $qty_new[$i];
                            $data->selling_price = $get_produk[0]['selling_price'];
                            $data->diskon_item = $disc_item * $qty_new[$i];
                            $data->diskon_all = $get_produk[0]['diskon_all'];
                            $data->subtotal = intval($get_produk[0]['selling_price'] * $qty_new[$i]) - intval($disc_item * $qty_new[$i]);
                            $data->grandtotal = $get_produk[0]['grandtotal'];
                            $data->cash = $get_produk[0]['cash'];
                            $data->bca = $get_produk[0]['bca'];
                            $data->mandiri = $get_produk[0]['mandiri'];
                            $data->qris = $get_produk[0]['qris'];
                            $data->ongkir = $get_produk[0]['ongkir'];
                            $data->refund = $get_produk[0]['refund'];
                            $data->users = $get_produk[0]['users'];
                            $data->save();
                            // End Save Function
                        }

                        // Update Variation QTY
                        variation::where('id_produk', $get_produk[0]['id_produk'])
                            ->where('id_area', $get_produk[0]['id_area'])
                            ->where('id_ware', $ware[$i])
                            ->where('size', $size_new[$i])
                            ->where('idpo', $get_var[$b]['idpo'])
                            ->update([
                                'qty' => $qty_sisa,
                            ]);
                        // QTY Update Variation QTY

                        $qty_sales = intval($qty_sales) - intval($get_qty);
                    }
                }
                // End cek stock Variasi Aktif


                if ($result_qty === 0) {
                    Sale::where('id', $id[$i])->delete();
                } else {
                    Sale::where('id', $id[$i])
                        ->update([
                            'qty' => $result_qty,
                            'subtotal' => intval($get_produk[0]['selling_price'] * $result_qty) - intval($disc_item * $result_qty),
                            'diskon_item' => $disc_item * $result_qty,
                        ]);
                }

                $old_qty = variation::where('id_produk', $get_produk[0]['id_produk'])
                    ->where('idpo', $get_produk[0]['idpo'])
                    ->where('id_ware', $get_produk[0]['id_ware'])
                    ->where('size', $get_produk[0]['size'])
                    ->get();

                $qty_kembali = intval($old_qty[0]['qty']) + intval($qty_new[$i]);

                variation::where('id_produk', $get_produk[0]['id_produk'])
                    ->where('idpo', $get_produk[0]['idpo'])
                    ->where('id_ware', $get_produk[0]['id_ware'])
                    ->where('size', $get_produk[0]['size'])
                    ->update([
                        'qty' => $qty_kembali,
                    ]);


                $total_retur = $total_retur + ($get_produk[0]['selling_price'] * $qty_new[$i]) - ($disc_item * $qty_new[$i]);

                DB::commit();
            }

            Return_order::where('id_invoice', $id_invoice)
                ->update([
                    'grandtotal' => $total_retur,
                ]);
        }



        return redirect('orderPaid/order_paids');
    }
}
