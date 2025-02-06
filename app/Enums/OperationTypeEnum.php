<?php

namespace App\Enums;

enum OperationTypeEnum: int
{
    case ACCRUAL = 1;
    case PURCHASE = 2;

    public static function toArray(): array
    {
        return [
            self::ACCRUAL->value => 'accrual',
            self::PURCHASE->value => 'purchase',
        ];
    }
}
