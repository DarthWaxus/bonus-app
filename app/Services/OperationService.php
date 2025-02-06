<?php

namespace App\Services;

use App\Enums\OperationStatusEnum;
use App\Enums\OperationTypeEnum;
use App\Exceptions\InsufficientBalanceException;
use App\Models\Operation;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class OperationService
{
    private WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * @throws InsufficientBalanceException
     */
    public function createOperation(Wallet $wallet, int $operationTypeId, int $amount): Operation
    {
        $this->validateOperationAmount($wallet, $operationTypeId, $amount);
        return $wallet->operations()->create([
            'operation_status_id' => OperationStatusEnum::PENDING->value,
            'operation_type_id' => $operationTypeId,
            'amount' => $amount
        ]);
    }

    /**
     * @throws InsufficientBalanceException
     */
    private function validateOperationAmount(Wallet $wallet, int $operationTypeId, int $amount): void
    {
        if (!$this->walletService->isBalanceEnough($wallet, $this->getOperationAmount($operationTypeId, $amount))) {
            throw new InsufficientBalanceException();
        }
    }

    public function approveOperation(Operation $operation): Operation
    {
        try {
            $this->validateOperationAmount($operation->wallet, $operation->operation_type_id, $operation->amount);

            DB::transaction(function () use ($operation) {
                $updateAmount = $this->getOperationAmount($operation->operation_type_id, $operation->amount);
                $this->walletService->updateWalletBalance($operation->wallet, $updateAmount);
                $this->updateOperationStatus($operation, OperationStatusEnum::APPROVED->value);
            });
        } catch (InsufficientBalanceException $exception) {
            $this->updateOperationStatus($operation, OperationStatusEnum::REJECTED->value);
        }
        return $operation->fresh();
    }

    public function updateOperationStatus(Operation $operation, int $operationStatusId): Operation
    {
        $operation->update([
            'operation_status_id' => $operationStatusId,
        ]);
        return $operation;
    }

    private function getOperationAmount(int $operationTypeId, int $amount): int
    {
        return match ($operationTypeId) {
            OperationTypeEnum::ACCRUAL->value => $amount,
            OperationTypeEnum::PURCHASE->value => -$amount,
        };
    }
}
