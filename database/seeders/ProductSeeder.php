<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'item_name'    => 'PP 450',
                'quantity'     => 0.450,
                'unit_price'   => 27,
                'packed_date'  => '2025-01-01',
                'expiry_date'  => '2026-01-01',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'pp 400',
                'quantity'     => 1,
                'unit_price'   => 24.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'sm 950',
                'quantity'     => .950,
                'unit_price'   => 55.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'sm 900',
                'quantity'     => .900,
                'unit_price'   => 53.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'sm 1000',
                'quantity'     => 1,
                'unit_price'   => 850.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'STD 450',
                'quantity'     => 0.450,
                'unit_price'   => 27.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'Tm 500',
                'quantity'     => .500,
                'unit_price'   => 26.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'curd can',
                'quantity'     => 1,
                'unit_price'   => 00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'curd 400',
                'quantity'     => 1,
                'unit_price'   => 25.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'item_name'    => 'curd 450',
                'quantity'     => 1,
                'unit_price'   => 25.00,
                'packed_date'  => '2025-02-01',
                'expiry_date'  => '2025-12-31',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
