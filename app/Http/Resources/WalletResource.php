<?php

namespace App\Http\Resources;

use App\Services\BonusProgramService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    protected BonusProgramService $bonusProgramService;

    public function __construct($resource, BonusProgramService $bonusProgramService)
    {
        parent::__construct($resource);
        $this->bonusProgramService = $bonusProgramService;
    }

    /**
     * @throws BindingResolutionException
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'money_balance' => $this->bonusProgramService->convertBonusesToMoneyForPurchase($this->bonusProgram, $this->balance),
        ];
    }
}
