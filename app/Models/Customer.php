<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $phone
 */
class Customer extends Model
{
    protected $fillable = ['phone'];

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
