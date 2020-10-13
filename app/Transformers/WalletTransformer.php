<?php

namespace App\Transformers;

use App\Models\Wallet;
use Flugg\Responder\Transformers\Transformer;

class WalletTransformer extends Transformer {
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'user'   => UserTransformer::class,
        'moneys' => MoneyTransformer::class
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * @param Wallet $wallet
     *
     * @return array
     */
    public function transform(Wallet $wallet) {
        return [
            'id'             => (int)$wallet->id,
            'user_id'        => $wallet->user_id,
            'surplus_amount' => $wallet->surplus_amount,
            'name'           => $wallet->name
        ];
    }
}
