<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // get user with role admin
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        $user->companies()->create([
            'name' => 'The Metamavericks',
            'creator_id' => $user->id,
            'currency_id' => 1
        ]);


    }
}
