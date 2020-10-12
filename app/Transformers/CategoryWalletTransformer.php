<?php

namespace App\Transformers;

use App\Models\CategoryWallet;
use Flugg\Responder\Transformers\Transformer;

class CategoryWalletTransformer extends Transformer {
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * @param CategoryWallet $categoryWallet
     *
     * @return int[]
     */
    public function transform(CategoryWallet $categoryWallet) {
        return [
            'id'         => (int)$categoryWallet->id,
            'name'       => $categoryWallet->name,
            'type'       => $categoryWallet->type,
            'created_at' => $categoryWallet->created_at,
            'updated_at' => $categoryWallet->updated_at
        ];
    }
}
