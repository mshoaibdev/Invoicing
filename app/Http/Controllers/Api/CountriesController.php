<?php
namespace App\Http\Controllers\Api;


use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\CountryResource;

class CountriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $countries = Country::all();

        return CountryResource::collection($countries);
    }
}
