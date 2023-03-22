<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\City;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $title = "Store";

        $getwarehouse = Warehouse::get();
        return view('store.stores', compact(
            'title',
            'getwarehouse'
        ));
    }

    public function tablestore(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::with('warehouses')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit_select_store(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;
            $getwarehouse = Warehouse::get();

            return view('store/edit_select_store', compact(
                'id_ware',
                'getwarehouse'
            ));
        }
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
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeadd(Request $request)
    {
        $cek = Store::count();
        if ($cek === 0) {
            $urut = 1;
            $idstore = "STR-" . $urut;
        } else {
            $ambildata = Store::all()->max('id_store');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idstore = 'STR-' . $cek3;
        }

        $getarea = DB::table('warehouses')->where('id_ware', '=', $request->id_ware)->get();

        $data = new Store();
        $data->id_store = $idstore;
        $data->id_ware = $request->id_ware;
        $data->id_area = $getarea[0]->id_area;
        $data->area = $getarea[0]->area;
        $data->store = Str::upper($request->store);
        $data->address = Str::headline($request->address);
        $data->save();

        return redirect('store/stores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $getarea = DB::table('warehouses')->where('id_ware', '=', $request->e_id_ware)->get();

        $data = Store::find($id);
        $data->id_ware = $request->e_id_ware;
        $data->id_area = $getarea[0]->id_area;
        $data->area = $getarea[0]->area;
        $data->store = Str::upper($request->e_store);
        $data->address = Str::headline($request->e_address);
        $data->update();
        return redirect('store/stores');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::destroy($id);

        return redirect('store/stores');
    }
}
