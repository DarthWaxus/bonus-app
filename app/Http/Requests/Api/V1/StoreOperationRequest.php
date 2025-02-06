<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $operation_type_id
 * @property int $amount
 */
class StoreOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'operation_type_id' => 'required|exists:operation_types,id',
            'amount' => 'required|int'
        ];
    }
}
