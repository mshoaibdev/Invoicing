<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BootstrapController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = $request->user();

        $companies = $user->companies()->get();

        $current_company = Company::find($request->header('company'));

        if ((!$current_company) || ($current_company && !$user->hasCompany($current_company->id))) {
            $current_company = $user->companies()->first();
        }

        return [
            'current_company' => $current_company,
            'companies' => $companies,
        ];

    }

}
