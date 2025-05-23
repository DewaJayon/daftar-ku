<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'user_id'           => 1,
            'customer_type_id'  => 1,
            'name'              => 'Web Laravel',
            'slug'              => 'web-laravel',
            'project_name'      => 'Web Laravel Daftar Ku',
            'tech_stack'        => 'Laravel',
            'status'            => 'pending',
        ]);
    }
}
