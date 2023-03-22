<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_order extends Model
{
    use HasFactory;

    protected $table = "return_orders";

    public function stores()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }

    public function warehouses()
    {
        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }
}
