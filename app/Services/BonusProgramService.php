<?php

namespace App\Services;

use App\Contracts\BonusConvertorInterface;
use App\Models\BonusProgram;
use App\Services\BonusConvertors\DefaultBonusConvertor;
use Illuminate\Contracts\Container\BindingResolutionException;

class BonusProgramService
{
    /**
     * @throws BindingResolutionException
     */
    public function getBonusConvertor(BonusProgram $bonusProgram): BonusConvertorInterface
    {
        return match ($bonusProgram->converter_type) {
            'default' => app()->make(DefaultBonusConvertor::class),
        };
    }

    /**
     * @throws BindingResolutionException
     */
    public function convertMoneyToBonusesForAccrual(BonusProgram $bonusProgram, int $moneyAmount): int
    {
        return $this->getBonusConvertor($bonusProgram)->convertMoneyToBonusesForAccrual($moneyAmount);
    }

    /**
     * @throws BindingResolutionException
     */
    public function convertBonusesToMoneyForPurchase(BonusProgram $bonusProgram, int $bonusesAmount): int
    {
        return $this->getBonusConvertor($bonusProgram)->convertBonusesToMoneyForPurchase($bonusesAmount);
    }

    /**
     * @throws BindingResolutionException
     */
    public function convertMoneyToBonusesForPurchase(BonusProgram $bonusProgram, int $moneyAmount): int
    {
        return $this->getBonusConvertor($bonusProgram)->convertMoneyToBonusesForPurchase($moneyAmount);
    }
}
