<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $converter_type
 */
class BonusProgram extends Model
{
    protected $fillable = ['name', 'converter_type'];
}
