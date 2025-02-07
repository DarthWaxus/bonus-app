<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\OperationType;
use Illuminate\Http\JsonResponse;

class OperationTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(OperationType::all());
    }
}
