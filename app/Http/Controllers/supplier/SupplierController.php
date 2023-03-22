<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function supplier()
    {
        $title = "Supplier";

        return view('supplier/suppliers', compact(
            'title'
        ));
    }

    public function tablesupplier(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
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
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Supplier::count();
        if ($cek === 0) {
            $urut = 1;
            $idsup = "SUP-" . $urut;
        } else {
            $ambildata = Supplier::all()->max('id_sup');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idsup = 'SUP-' . $cek3;
        }
        $data = new Supplier();
        $data->id_sup = $idsup;
        $data->supplier = Str::headline($request->supplier);
        $data->tlp = $request->tlp;
        $data->save();

        return redirect('supplier/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $data = Supplier::find($id);
        $data->supplier = $request->e_supplier;
        $data->tlp = $request->e_tlp;
        $data->update();

        return redirect('supplier/suppliers');
    }

    /**
     * Update the specified resource in storage.
     *

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::destroy($id);

        return redirect('supplier/suppliers');
    }
}
