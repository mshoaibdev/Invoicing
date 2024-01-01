<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Store;
use App\Http\Requests\Company\Update;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    use Upload;

    // public function __construct()
    // {
    //     $this->middleware(['permission:settings-company-list|settings-company-create|settings-company-edit|settings-company-delete']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::query()
            ->when($request->q, function ($query, $string) use ($request) {
                $query->search($request->q);
            })
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $user = $request->user();

        $company = Company::create($request->getCompanyPayload());

        $user->companies()->attach($company->id);

        if ($request->address) {
            $company->address()->create($request->getAddressPayload());
        }

        if ($request->hasFile('logo')) {
            $this->uploadLogo($request, $company);
        }


        return response()->json([
            'data' => $company,
            'message' => 'Company successfully added.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Company $company)
    {
        $company->update($request->getCompanyPayload());

        if ($request->address) {
            $company->address()->update($request->getAddressPayload());
        }

        if ($request->hasFile('logo')) {
            $this->uploadLogo($request, $company);
        }


        return response()->json([
            'data' => $company,
            'message' => 'Company successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([
            'message' => 'Company successfully deleted.',
        ]);
    }

    // upload logo

    public function uploadLogo(Request $request, $company)
    {


        if (isset($request->is_company_logo_removed) && (bool) $request->is_company_logo_removed) {
            $company->clearMediaCollection('logo');
        }

        if ($company) {
            $company->clearMediaCollection('logo');

            $company->addMediaFromRequest('logo')
            
                ->usingFileName($request->file('logo')->getClientOriginalName())
                ->toMediaCollection('logo');
        }
    }

    // getCompanies

    public function getCompanies(Request $request)
    {
        $companies = Company::query()
            ->latest()
            ->get();

        return CompanyResource::collection($companies);
    }

    // currentCompany

    public function currentCompany(Request $request)
    {
        $company = Company::query()
            ->with(['address', 'currency', 'country'])
            ->where('id', $request->header('company'))
            ->firstOrFail();

        return new CompanyResource($company);
    }

}
