<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $wallet_id
 * @property int $amount
 * @property int $operation_type_id
 * @property int $operation_status_id
 * @property Wallet $wallet
 * @property OperationType $operationType
 * @property OperationStatus $operationStatus
 */
class Operation extends Model
{
    protected $fillable = ['wallet_id', 'amount', 'operation_type_id', 'operation_status_id'];

    public function operationType(): BelongsTo
    {
        return $this->belongsTo(OperationType::class);
    }

    public function operationStatus(): BelongsTo
    {
        return $this->belongsTo(OperationStatus::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
