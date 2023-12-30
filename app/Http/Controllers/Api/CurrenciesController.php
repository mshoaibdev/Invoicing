<?php
namespace App\Http\Controllers\Api;


use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\CurrencyResource;

class CurrenciesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $countries = Currency::all();

        return CurrencyResource::collection($countries);
    }
}
