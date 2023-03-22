<?php

namespace App\Http\Controllers\orderreseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderResellerController extends Controller
{
    public function orderresellers()
    {
        $title = "Orders Reseller";

        return view('/orderreseller/orderresellers', compact(
            'title'
        ));
    }
}
