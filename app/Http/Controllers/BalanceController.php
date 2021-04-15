<?php

namespace App\Http\Controllers;

use AvtoDev\JsonRpc\Requests\RequestInterface;

class BalanceController extends Controller
{
    public function userBalance(RequestInterface $request): string
    {
        return 'nello';
    }
}
