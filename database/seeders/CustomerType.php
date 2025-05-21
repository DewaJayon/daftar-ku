<?php

namespace Database\Seeders;

use App\Models\CustomerType as ModelsCustomerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsCustomerType::create([
            'name' => 'Mahasiswa',
        ]);
    }
}
