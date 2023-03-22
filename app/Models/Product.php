<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function product_variation()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->orderBy('size')->groupBy('size', 'id_produk', 'id_ware');
    }

    public function product_variation2()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->orderBy('size')->groupBy('size', 'id_produk', 'id_ware');
    }

    public function product_variation3()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->groupBy('id_produk');
    }

    public function product_variation_asset()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk');
    }


    public function warehouse()
    {
        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }

    public function image_product()
    {
        return $this->hasMany(Image_product::class, 'id_produk', 'id_produk');
    }

    public function supplier_order()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk');
    }

    public function supplier_order2()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk')->groupBy('id_produk');
    }

    public function supplier_order3()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->groupBy('tipe_order', 'id_produk');
    }

    public function supplier_variation()
    {
        return $this->hasMany(supplier_variation::class, 'id_produk', 'id_produk');
    }

    public function areas()
    {
        return $this->hasMany(City::class, 'id_area', 'id_area');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'id_ware', 'id_ware');
    }

    public function display()
    {
        return $this->hasMany(Displays::class, 'id_produk', 'id_produk');
    }

    public function print_variation()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('id_produk,id_ware,COUNT(size) as c_size')->groupBy('id_ware', 'id_produk');
    }
}
