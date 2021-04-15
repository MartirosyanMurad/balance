<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use function is_null;

/**
 * @package App\Repository
 */
class BalanceRepository
{
    /**
     * @param int $userId
     *
     * @return float
     */
    public function getBalance(int $userId): float
    {
        $balance = DB::table('balance_history')
                        ->where('user_id', '=', $userId)
                        ->orderBy('id', 'desc')
                        ->first();


        if (is_null($balance)) {
            return 0.0;
        }

        return $balance->balance;
    }

    /**
     * @param int $userId
     * @param int $limit
     *
     * @return array
     */
    public function getBalanceHistory(int $userId, int $limit): array
    {
        $balanceHistories = DB::table('balance_history')
                            ->where('user_id', '=', $userId)
                            ->orderBy('id', 'desc')
                            ->take($limit)
                            ->get();

        $history = [];
        foreach ($balanceHistories as $balanceHistory) {
            $history[] = [
              'value' => $balanceHistory->value,
              'created_at' => $balanceHistory->created_at
            ];
        }

        return $history;
    }
}
