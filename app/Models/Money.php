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
}
