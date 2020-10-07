<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Money extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_money_id', 'user_id', 'amount'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoryMoney() {
        return $this->belongsTo(CategoryMoney::class, 'category_money_id', 'id');
    }
}
