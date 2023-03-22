<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeproduct_piutangRequest;
use App\Http\Requests\Updateproduct_piutangRequest;
use App\Models\product_piutang;

class ProductPiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storeproduct_piutangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproduct_piutangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_piutang  $product_piutang
     * @return \Illuminate\Http\Response
     */
    public function show(product_piutang $product_piutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_piutang  $product_piutang
     * @return \Illuminate\Http\Response
     */
    public function edit(product_piutang $product_piutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproduct_piutangRequest  $request
     * @param  \App\Models\product_piutang  $product_piutang
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproduct_piutangRequest $request, product_piutang $product_piutang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_piutang  $product_piutang
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_piutang $product_piutang)
    {
        //
    }
}
