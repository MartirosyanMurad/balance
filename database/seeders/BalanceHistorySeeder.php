<?php

declare(strict_types=1);

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @package Database\Seeders
 */
class BalanceHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        for ($i = 0; $i <= 30; $i++) {
            DB::table('balance_history')->insert([
                'user_id' => random_int(1, 5),
                'balance' => random_int(0, 10000) / 10,
                'value' => random_int(-400, 400) / 10,
            ]);
        }
    }
}
