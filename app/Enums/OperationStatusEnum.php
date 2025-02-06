<?php

namespace App\Enums;

enum OperationStatusEnum: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case REJECTED = 3;
    case CANCELED = 4;

    public static function toArray(): array
    {
        return [
            self::PENDING->value => 'pending',
            self::APPROVED->value => 'approved',
            self::REJECTED->value => 'rejected',
            self::CANCELED->value => 'canceled',
        ];
    }
}
