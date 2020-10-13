<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer {
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'wallets' => WalletTransformer::class
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];


    public function transform(User $user) {
        return [
            'id'           => (int)$user->id,
            'name'         => $user->name,
            'number_phone' => $user->number_phone,
            'email'        => $user->email
        ];
    }
}
