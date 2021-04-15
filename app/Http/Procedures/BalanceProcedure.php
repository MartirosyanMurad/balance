<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Repository\BalanceRepository;
use Illuminate\Http\Request;
use JsonException;
use Sajya\Server\Procedure;

/**
 * @package App\Http\Procedures
 */
class BalanceProcedure extends Procedure
{
    private BalanceRepository $repository;

    /**
     * BalanceProcedure constructor.
     *
     * @param BalanceRepository $balanceRepository
     */
    public function __construct(BalanceRepository $balanceRepository)
    {
        $this->repository = $balanceRepository;
    }

    /**
     * @inheritdoc
     */
    public static string $name = 'balance';

    /**
     * @param Request $request
     *
     * @return float
     */
    public function userBalance(Request $request): float
    {
        $request->validate([
            'user_id' => 'required|integer|numeric',
        ]);

        $userId = $request->input('user_id');

        return $this->repository->getBalance($userId);
    }

    /**
     * @param Request $request
     *
     * @return string
     * @throws JsonException
     */
    public function history(Request $request): string
    {
        $request->validate([
            'user_id' => 'required|integer|numeric',
            'limit' => 'required|integer|numeric'
        ]);

        $userId = $request->input('user_id');
        $limit =  $request->input('limit');

        $history = $this->repository->getBalanceHistory($userId, $limit);

        return json_encode($history, JSON_THROW_ON_ERROR);
    }

}

