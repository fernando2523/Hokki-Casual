<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDisplayRequest;
use App\Http\Requests\UpdateDisplayRequest;
use App\Models\Display;
use App\Models\Product;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;

class DisplayController extends Controller
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
     * @param  \App\Http\Requests\StoreDisplayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisplayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Display  $display
     * @return \Illuminate\Http\Response
     */
    public function show(Display $display)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Display  $display
     * @return \Illuminate\Http\Response
     */
    public function edit(Display $display)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDisplayRequest  $request
     * @param  \App\Models\Display  $display
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisplayRequest $request, Display $display)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Display  $display
     * @return \Illuminate\Http\Response
     */
    public function destroy(Display $display)
    {
        //
    }

    public function print_so(Request $request)
    {
        $product = Product::with('store', 'image_product', 'display')->groupBy('id_produk')->get();

        $data = [
            'product' => $product,
        ];
        $pdf = MPDF::loadView(
            'displays.print_sodisplay',
            $data,
            [],
            [
                'format' => 'A4',
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
