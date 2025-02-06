<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\User;
use App\Models\Wallet;

class WalletService
{
    public function createWallet(int $customerId, int $bonusProgramId): Wallet
    {
        /** @var Customer $customer */
        $customer = Customer::findOrFail($customerId);
        return $customer->wallets()->create(['bonus_program_id' => $bonusProgramId]);
    }

    public function isBalanceEnough(Wallet $wallet, int $amount): bool
    {
        return ($wallet->balance + $amount) >= 0;
    }

    public function updateWalletBalance(Wallet $wallet, int $amount): void
    {
        $wallet->increment('balance', $amount);
    }
}
