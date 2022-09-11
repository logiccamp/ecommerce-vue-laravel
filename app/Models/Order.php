<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function BreakDown()
    {
        return $this->hasMany(OrderBreakDown::class, "order_id", "id");
    }

    public function Details()
    {
        return $this->hasOne(OrderDetails::class, "order_id", "id");
    }
}
