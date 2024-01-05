<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaypalController extends Controller
{
    //

    // paypal notify invoke

    public function __invoke(Request $request)
    {

        \Log::info($request->all());
    }

}
