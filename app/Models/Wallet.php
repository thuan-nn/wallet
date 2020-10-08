<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'wallet_category_id',
        'name'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoryWallet() {
        return $this->belongsTo(CategoryWallet::class, 'category_wallet_id', 'id');
    }
}
