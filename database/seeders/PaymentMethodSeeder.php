<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $paymentMethods = [
            [
                'name' => 'Athorize.net',
                'company_id' => 1,
                'is_enabled' => 1,
                'is_default' => 1,
                'is_gateway' => 1,
            ],
            [
                'name' => 'Paypal',
                'company_id' => 1,
                'is_enabled' => 0,
                'is_default' => 0,
                'is_gateway' => 1,
            ],
            [
                'name' => 'Cash',
                'company_id' => 1,
                'is_enabled' => 0,
                'is_default' => 0,
                'is_gateway' => 0,
            ],
            [
                'name' => 'Check',
                'company_id' => 1,
                'is_enabled' => 0,
                'is_default' => 0,
                'is_gateway' => 0,
            ],
            [
                'name' => 'Bank Transfer',
                'company_id' => 1,
                'is_enabled' => 0,
                'is_default' => 0,
                'is_gateway' => 0,
            ],
            [
                'name' => 'Payoneer',
                'company_id' => 1,
                'is_enabled' => 0,
                'is_default' => 0,
                'is_gateway' => 0,
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }
}
