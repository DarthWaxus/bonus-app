<?php

namespace App\Contracts;

interface BonusConvertorInterface
{
    public function convertMoneyToBonusesForAccrual(int $moneyAmount): int;

    public function convertBonusesToMoneyForPurchase(int $bonusesAmount): int;

    public function convertMoneyToBonusesForPurchase(int $moneyAmount): int;
}
