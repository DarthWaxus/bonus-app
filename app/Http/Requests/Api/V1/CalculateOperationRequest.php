<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $money_amount
 * @property int $operation_type_id
 */
class CalculateOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'money_amount' => 'required|int',
            'operation_type_id' => 'required|int'
        ];
    }
}
