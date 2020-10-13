<?php


namespace App\Action;


use App\Enums\MoneyTypeEnum;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CreateMoneyAction {
    public function execute($data, $user) {
        try {
            DB::beginTransaction();
            $money = $user->money()->create($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new $exception;
        }
    }

    public function totalMoney(Wallet $wallet, $type, $amountMoney) {
    }
}
