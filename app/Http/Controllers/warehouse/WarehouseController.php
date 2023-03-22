<?php

namespace App\Http\Controllers\warehouse;

use App\Http\Controllers\Controller;
use App\Models\warehouse;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StorewarehouseRequest;
use App\Http\Requests\UpdatewarehouseRequest;
use Illuminate\Support\Str;


class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function warehouse()
    {
        $title = "Warehouse";
        $getarea = City::all();

        return view('warehouse.warehouses', compact(
            'title',
            'getarea'
        ));
    }

    public function tablewarehouse(Request $request)
    {
        if ($request->ajax()) {
            $data = Warehouse::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit_select_ware(Request $request)
    {
        if ($request->ajax()) {
            $id_area = $request->id_area;
            $area = $request->area;
            $getarea = City::all();

            return view('warehouse/edit_select_ware', compact(
                'id_area',
                'area',
                'getarea'
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
     * @param  \App\Http\Requests\StorewarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Warehouse::count();
        if ($cek === 0) {
            $urut = 1;
            $idware = "WARE-" . $urut;
        } else {
            $ambildata = Warehouse::all()->max('id_ware');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idware = 'WARE-' . $cek3;
        }

        $data = new warehouse();
        $data->id_ware = $idware;
        $data->warehouse = Str::headline($request->warehouse);
        $data->id_area = $request->id_area;
        $data->area = $request->r_kota;
        $data->address = $request->address;
        $data->save();

        return redirect('warehouse/warehouses');
    }

    public function editact(Request $request, $id)
    {
        $data = Warehouse::find($id);
        if ($request->e_kota === null) {
            $data->warehouse = $request->e_warehouse;
            $data->address = $request->e_address;
            $data->id_area = $request->e_id_area;
            $data->area = $request->e_kota_default;
        } else {
            $data->warehouse = $request->e_warehouse;
            $data->address = $request->e_address;
            $data->id_area = $request->e_id_area;
            $data->area = $request->e_kota;
        }
        $data->update();

        return redirect('warehouse/warehouses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatewarehouseRequest  $request
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatewarehouseRequest $request, warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::destroy($id);

        return redirect('warehouse/warehouses');
    }
}
