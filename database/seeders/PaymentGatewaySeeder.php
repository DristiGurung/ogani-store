<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentGateway::create([
            'name' => 'Cash on Delivery',
            'code' => 'cod',
            
        ]);
        
        PaymentGateway::create([
            'name' => 'Khalti',
            'code' => 'khalti',
            
        ]);
    }
}
