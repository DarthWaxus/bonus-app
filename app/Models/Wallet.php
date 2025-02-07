<?php

namespace App\Models;

use App\Services\BonusProgramService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read  int $id
 * @property  int $customer_id
 * @property  int $bonus_program_id
 * @property  int $balance
 * @property-read  BonusProgram $bonusProgram
 * @property-read  Customer $customer
 */
class Wallet extends Model
{
    protected $fillable = ['customer_id', 'bonus_program_id'];
    protected $with = ['bonusProgram'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function bonusProgram(): BelongsTo
    {
        return $this->belongsTo(BonusProgram::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
}
