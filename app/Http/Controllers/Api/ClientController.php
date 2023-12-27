<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Store;
use App\Http\Requests\Client\Update;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    use Upload;

    public function __construct()
    {
        // $this->middleware(['permission:settings-client-list|settings-client-create|settings-client-edit|settings-client-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Client::query()

            ->when($request->q, function ($query, $string) use ($request) {
                $query->search($request->q);
            })
            ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

        return ClientResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->validated();
        if ($request->logo) {
            $fileName = $this->uploadBase64AvatarAndResize($request->logo, 'client');
            $data['logo'] = $fileName;
        }

        $client = Client::create($data);

        return response()->json([
            'data' => $client,
            'message' => 'Client successfully added.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Client $client)
    {
        $data = $request->validated();
        // dd($data);
        if ($request->filled('new_logo')) {
            $fileName = $this->uploadBase64AvatarAndResize($request->new_logo, 'client');
            $data['logo'] = $fileName;
        }

        $client->update($data);

        return response()->json([
            'data' => $client,
            'message' => 'Client successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'Client successfully deleted.',
        ]);
    }
}
