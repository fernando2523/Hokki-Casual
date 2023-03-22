<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brand()
    {
        $title = "Brand";

        return view('brand.brands', compact(
            'title',
        ));
    }

    public function tablebrand(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();
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
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Brand::count();
        if ($cek === 0) {
            $urut = 1;
            $idbrn = "BRN-" . $urut;
        } else {
            $ambildata = Brand::all()->max('id_brand');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idbrn = 'BRN-' . $cek3;
        }

        $ceks = Brand::count();
        if ($ceks === 0) {
            $urut2 = 10;
            $codes = $urut2;
        } else {
            $ambildata = Brand::all()->max('code');
            $ceks2 = $ambildata + 1;
            $codes = $ceks2;
        }

        $data = new Brand();
        $data->id_brand = $idbrn;
        $data->brand = $request->brand;
        $data->code = $codes;

        if (empty($_FILES['file']['name'][0])) {
            $data->img = "";
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('brand'), $fileName);
            // end get files
            $data->img = $fileName;
        }

        $data->save();

        return redirect('brand/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request)
    {
        $id = $request->e_id;
        $data = Brand::find($id);
        $data->brand = $request->e_brand;
        if (empty($_FILES['file']['name'][0])) {
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);

            if ($data->img === null or $data->img === "") {
            } else {
                $image = Brand::find($id);
                unlink("brand/" . $image->img);
            }

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('brand'), $fileName);
            // end get file
            $data->img = $fileName;
        }
        $data->update();

        return redirect('brand/brands');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->del_img === null or $request->del_img === "") {
            brand::destroy($id);
        } else {
            brand::destroy($id);
            unlink("brand/" . $request->del_img);
        }

        return redirect('brand/brands');
    }
}
