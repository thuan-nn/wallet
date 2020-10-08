<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMoney extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'type'
    ];

    public function moneies() {
        return $this->hasMany(Money::class, 'category_money_id', 'id');
    }
}
