<?php

namespace App\Http\Controllers\area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    public function area()
    {
        $title = "Area";

        return view('area.areas', compact(
            'title'
        ));
    }

    public function tablearea(Request $request)
    {
        if ($request->ajax()) {
            $city = City::latest()->get();
            return DataTables::of($city)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function editact(Request $request, $id)
    {
        $data = City::find($id);
        $data->up_price = preg_replace("/[^0-9]/", "", $request->up_price);
        $data->update();

        return redirect('area/areas');
    }
}
