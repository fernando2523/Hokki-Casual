<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    public function details()
    {
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice')->selectRaw('*,SUM(qty) as qty,SUM(diskon_item) as diskon_item,SUM(subtotal) as subtotal')->groupBy('id_produk', 'size', 'id_invoice', 'tanggal');
    }

    public function details2()
    {
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice')->selectRaw('*,SUM(qty) as qty,sum(m_price*qty) as cost,SUM(diskon_item) as diskon_item,SUM(subtotal) as subtotal')->groupBy('id_produk', 'size', 'id_invoice');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }

    public function reseller()
    {
        return $this->hasMany(Reseller::class, 'id_reseller', 'id_reseller');
    }

    public function image_product()
    {
        return $this->hasMany(Image_product::class, 'id_produk', 'id_produk');
    }

    ///////////////////////////////////////////////////////////////////////////
    // report product
    public function qtys()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->groupBy('id_produk');
    }

    public function disc_item()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->groupBy('id_produk')->selectRaw('*,SUM(diskon_item) as disc');
    }

    public function disc_all()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->groupBy('id_produk');
    }

    public function gross()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function costs()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function profit()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function store_inv()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }

    public function details_inv()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function report_store()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }
    //end report product
    ///////////////////////////////////////////////////////////////////////////
    public function details_pending()
    {
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice');
    }
}
