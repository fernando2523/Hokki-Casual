<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_order extends Model
{
    use HasFactory;

    protected $table = "supplier_orders";

    public function supplier_variation()
    {
        return $this->hasMany(Supplier_variation::class, 'idpo', 'idpo')->orderBy('idpo');
    }

    public function supplier_variation2()
    {
        return $this->hasMany(Supplier_variation::class, 'id_produk', 'id_produk');
    }

    public function supplier_variation3()
    {
        return $this->hasMany(Supplier_variation::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->orderBy('size')->groupBy('size', 'id_produk', 'id_ware');
    }

    public function suppliers_detail()
    {
        return $this->hasMany(Supplier::class, 'id_sup', 'id_sup');
    }

    public function suppliers_details()
    {
        return $this->hasMany(Supplier_order::class, 'idpo', 'idpo');
    }

    public function product_variation_asset()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk');
    }

    public function supplier_order3()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->groupBy('tipe_order', 'id_produk');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->selectRaw('*,sum(qty) as sold')->groupBy('id_produk');
    }

    public function stock()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('*,sum(qty) as stock')->groupBy('id_produk', 'idpo');
    }

    public function details_po()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk');
    }

    public function asset_value()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->selectRaw('*,sum(qty) as stock')->groupBy('id_produk');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_produk', 'id_produk')->groupBy('id_produk');
    }

    public function warehouse()
    {
        return $this->hasMany(warehouse::class);
    }

    public function warehouse2()
    {
        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }

    public function warehouse3()
    {
        return $this->hasMany(warehouse::class, 'id_ware', 'id_ware');
    }
}
