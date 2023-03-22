<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = "stores";

    public function warehouses()
    {

        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'id_store', 'id_store')->groupBy('id_store');
    }

    public function detailsarea()
    {
        return $this->hasMany(City::class, 'id_area', 'id_area');
    }
}
