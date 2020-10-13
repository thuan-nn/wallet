<?php

namespace App\Models;

use App\Builders\WalletBuilder;
use App\Supports\Traits\OverridesBuilder;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model {
    use HasFactory, OverridesBuilder, SoftDeletes, Timestamp;

    public function provideCustomBuilder() {
        return WalletBuilder::class;
    }

    protected $table = 'wallets';

    protected $fillable = [
        'user_id',
        'surplus_amount',
        'name'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function moneys() {
        return $this->hasMany(Money::class, 'wallet_id', 'id');
    }
}
