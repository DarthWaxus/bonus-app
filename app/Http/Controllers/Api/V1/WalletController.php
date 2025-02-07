<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreWalletRequest;
use App\Http\Resources\WalletResource;
use App\Models\Customer;
use App\Models\Wallet;
use App\Services\BonusProgramService;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(Customer $customer, Request $request): JsonResponse
    {
        $wallets = $customer->wallets()->with('bonusProgram')->paginate();
        return response()->json($wallets);
    }

    public function store(Customer $customer, StoreWalletRequest $request, WalletService $walletService): JsonResponse
    {
        return response()->json($walletService->createWallet($customer->id, $request->validated('bonus_program_id')));
    }

    public function show(Wallet $wallet, BonusProgramService $bonusProgramService): JsonResponse
    {
        return response()->json(new WalletResource($wallet, $bonusProgramService));
    }
}
