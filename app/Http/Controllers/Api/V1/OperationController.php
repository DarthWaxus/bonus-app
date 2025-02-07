<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OperationTypeEnum;
use App\Exceptions\InsufficientBalanceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CalculateOperationRequest;
use App\Http\Requests\Api\V1\AccrualOperationRequest;
use App\Http\Requests\Api\V1\PurchaseOperationRequest;
use App\Http\Requests\Api\V1\StoreOperationRequest;
use App\Models\Operation;
use App\Models\Wallet;
use App\Services\BonusProgramService;
use App\Services\OperationService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Throwable;

class OperationController extends Controller
{
    public function index(Wallet $wallet): JsonResponse
    {
        return response()->json(
            $wallet
                ->operations()
                ->with('operationType')
                ->with('operationStatus')
                ->paginate()
        );
    }

    public function store(
        StoreOperationRequest $request,
        Wallet                $wallet,
        OperationService      $operationService): JsonResponse
    {
        try {
            $operation = $operationService->createOperation(
                $wallet,
                $request->validated('operation_type_id'),
                $request->validated('bonuses_amount')
            );
            $operation = $operationService->approveOperation($operation);
            $operation->load(['operationStatus', 'operationType', 'wallet']);
            return response()->json($operation);
        } catch (InsufficientBalanceException) {
            return response()->json(['message' => __('Insufficient balance')], 400);
        } catch (BindingResolutionException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function accrual(
        AccrualOperationRequest $request,
        Wallet                  $wallet,
        OperationService        $operationService): JsonResponse
    {
        try {
            $operation = $operationService->createAccrualOperation(
                $wallet,
                $request->validated('purchase_money_amount')
            );
            $operation = $operationService->approveOperation($operation);
            $operation->load(['operationStatus', 'operationType', 'wallet']);
            return response()->json($operation);
        } catch (InsufficientBalanceException) {
            return response()->json(['message' => __('Insufficient balance')], 400);
        } catch (BindingResolutionException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function purchase(
        PurchaseOperationRequest $request,
        Wallet                   $wallet,
        OperationService         $operationService): JsonResponse
    {
        try {
            $operation = $operationService->createPurchaseOperation(
                $wallet,
                $request->validated('purchase_money_amount')
            );
            $operation = $operationService->approveOperation($operation);
            $operation->load(['operationStatus', 'operationType', 'wallet']);
            return response()->json($operation);
        } catch (InsufficientBalanceException) {
            return response()->json(['message' => __('Insufficient balance')], 400);
        } catch (BindingResolutionException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show(Operation $operation): JsonResponse
    {
        return response()->json($operation);
    }

    public function calculate(Wallet $wallet, CalculateOperationRequest $request, BonusProgramService $bonusProgramService): JsonResponse
    {
        try {
            $operationType = (int)$request->validated('operation_type_id');
            $bonusesAmount = match ($operationType) {
                OperationTypeEnum::ACCRUAL->value => $bonusProgramService->convertMoneyToBonusesForAccrual($wallet->bonusProgram, $request->money_amount),
                OperationTypeEnum::PURCHASE->value => $bonusProgramService->convertMoneyToBonusesForPurchase($wallet->bonusProgram, $request->money_amount),
                default => throw new InvalidArgumentException("Invalid operation type: $operationType"),
            };
            return response()->json([
                'bonuses_amount' => $bonusesAmount
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
