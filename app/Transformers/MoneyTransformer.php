<?php

namespace App\Transformers;

use App\Enums\MoneyTypeEnum;
use App\Models\Money;
use Flugg\Responder\Transformers\Transformer;

class MoneyTransformer extends Transformer {
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'wallet' => WalletTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param \App\Money $money
     *
     * @return array
     */
    public function transform(Money $money) {
        return [
            'id'        => (int)$money->id,
            'wallet_id' => $money->wallet_id,
            'amount'    => $money->amount,
            'type'      => MoneyTypeEnum::getKey($money->type),
            'name'      => $money->name
        ];
    }
}
