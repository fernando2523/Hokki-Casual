<?php

namespace App\Http\Controllers\category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Sub_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $title = "Category";

        $getcategory = Category::get();

        return view('category/categories', compact(
            'title',
            'getcategory'
        ));
    }

    public function tablecategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function tablesubcategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Sub_category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function editselectcategory(Request $request)
    {
        if ($request->ajax()) {
            $id_cat_default = $request->id_cat;
            $category_default = $request->category;
            $getcategory = Category::get();

            return view('category/editselectcategory', compact(
                'id_cat_default',
                'getcategory',
                'category_default'
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Category::count();
        if ($cek === 0) {
            $urut = 1;
            $idcat = "CAT-" . $urut;
        } else {
            $ambildata = Category::all()->max('id_cat');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idcat = 'CAT-' . $cek3;
        }

        $data = new Category();
        $data->id_cat = $idcat;
        $data->category = strtoupper($request->category);
        $data->save();

        return redirect('category/categories');
    }

    public function storeadd(Request $request)
    {
        $cek = Sub_category::count();
        if ($cek === 0) {
            $urut = 1;
            $idsubcat = "SUB-" . $urut;
        } else {
            $ambildata = Sub_category::all()->max('id_catsub');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idsubcat = 'SUB-' . $cek3;
        }

        $getidcat = $request->id_cat;
        $getcategory = DB::table('categories')
            ->where('id_cat', '=', $getidcat)
            ->pluck('category');
        $getcategory2 = $getcategory->toArray();
        $getcategory3 = implode(" ", $getcategory2);

        $data = new Sub_category();
        $data->id_catsub = $idsubcat;
        $data->sub_category = strtoupper($request->sub_category);
        $data->id_cat = $getidcat;
        $data->category = strtoupper($getcategory3);
        $data->save();

        return redirect('category/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $getidcat = $request->e_id_cat;

        $data = Category::find($id);
        $data->category = strtoupper($request->e_category);
        Sub_category::where('id_cat', $getidcat)
            ->update([
                'category' => strtoupper($request->e_category)
            ]);
        $data->update();

        return redirect('category/categories');
    }

    public function editactsub(Request $request, $id)
    {
        $getidcat = $request->esub_id_cat;
        $getcategory = DB::table('categories')
            ->where('id_cat', '=', $getidcat)
            ->pluck('category');
        $getcategory2 = $getcategory->toArray();
        $getcategory3 = implode(" ", $getcategory2);

        $data = Sub_category::find($id);
        $data->sub_category = strtoupper($request->esub_sub_category);
        $data->id_cat = $request->esub_id_cat;
        $data->category = strtoupper($getcategory3);
        $data->update();

        return redirect('category/categories');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect('category/categories');
    }

    public function destroysub($id)
    {
        Sub_category::destroy($id);

        return redirect('category/categories');
    }
}
