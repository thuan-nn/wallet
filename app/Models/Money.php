<?php

namespace App\Models;

use App\Builders\MoneyBuilder;
use App\Supports\Traits\OverridesBuilder;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Money extends Model {
    use HasFactory, OverridesBuilder, SoftDeletes, Timestamp;

    public function provideCustomBuilder() {
        return MoneyBuilder::class;
    }

    protected $table = 'moneys';

    protected $fillable = [
        'wallet_id', 'amount', 'type', 'name'
    ];

    public function wallet() {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }
}
