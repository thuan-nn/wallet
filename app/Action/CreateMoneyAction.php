<?php


namespace App\Action;


use Illuminate\Support\Facades\DB;

class CreateMoneyAction {
    public function execute($data, $user) {
        try {
            DB::beginTransaction();
            $user->money()->create($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new $exception;
        }
    }

    public function totalMoney() {

    }
}
