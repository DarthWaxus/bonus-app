<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Customer::paginate());
    }

    public function store(StoreCustomerRequest $request, CustomerService $customerService): JsonResponse
    {
        return response()->json($customerService->createCustomer($request->phone));
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }
}
