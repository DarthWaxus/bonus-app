<?php

namespace App\Services\BonusConvertors;

use App\Contracts\BonusConvertorInterface;

//TODO переделать релизацию конвертора с учетом требований
class DefaultBonusConvertor implements BonusConvertorInterface
{
    /**
     * Расчет бонусов для начисления на основе переданной суммы покупки
     * @param int $moneyAmount
     * @return int
     */
    public function convertMoneyToBonusesForAccrual(int $moneyAmount): int
    {
        return (int)round($moneyAmount / 100);
    }

    /**
     * Перевод бонусов в денежный эквивалент для списания
     * @param int $bonusesAmount
     * @return int
     */
    public function convertBonusesToMoneyForPurchase(int $bonusesAmount): int
    {
        return (int)round($bonusesAmount * 100);
    }

    /**
     * Перевод денежного эквивалента в бонусы для списания
     * @param int $moneyAmount
     * @return int
     */
    public function convertMoneyToBonusesForPurchase(int $moneyAmount): int
    {
        return (int)round($moneyAmount / 100);
    }
}
