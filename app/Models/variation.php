<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variation extends Model
{
    use HasFactory;

    protected $table = "variations";

    protected $fillable = [
        'size',
        'qty',
    ];


    public function warehouse()
    {
        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }

    public function supplier()
    {
        return $this->hasMany(Supplier_order::class, 'idpo', 'idpo');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_produk', 'id_produk')->groupBy('id_produk');
    }
}
