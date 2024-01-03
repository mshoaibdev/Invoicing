<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class LeadsWebhookController extends Controller
{
    //

    public function __invoke(Request $request)
    {

        // DB Transaction

        $result = \DB::transaction(function () use ($request) {

            // create new customer
            try {
                $user = User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->first();

                
                $customer = Customer::where([
                    'email' => $request->email,
                    'company_id' => $request->company_id,
                ])->first();

                if (!$customer) {
                    $customer = Customer::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'company_id' => $request->company_id,
                        'currency_id' => $request->currency_id,
                        'creator_id' => $user->id,
                    ]);

                    // if phone 
                    if ($request->phone) {
                        $customer->addresses()->create([
                            'phone' => $request->phone,
                            'country_id' => 166,
                            'type' => 'billing',
                        ]);
                    }
                }

                // create new payment

                $customer->payments()->create([
                    'company_id' => $request->company_id,
                    'payment_method_id' => 1,
                    'amount' => $request->amount,
                    'payment_date' => $request->payment_date,
                    'notes' => $request->notes,
                    'transactionId' => $request->payment_number,
                    'order_details' => $request->order_details,
                ]);
            } catch (\Throwable $th) {
                
               return $th->getMessage();
            }

            return true;
        });

        if ($result === true) {
            return response()->json([
                'status' => true,
                'message' => 'Payment created successfully',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => $result,
        ], 500);


      
    }

}
