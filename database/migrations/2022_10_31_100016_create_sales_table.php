<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('id_invoice');
            $table->string('id_produk');
            $table->string('idpo');
            $table->string('id_area');
            $table->string('id_ware');
            $table->string('id_store');
            $table->string('id_brand');
            $table->string('id_reseller');
            $table->string('payment');
            $table->string('customer');
            $table->string('quality');
            $table->string('produk');
            $table->string('size');
            $table->string('qty');
            $table->string('m_price');
            $table->string('selling_price');
            $table->string('diskon_item');
            $table->string('diskon_all');
            $table->string('subtotal');
            $table->string('grandtotal');
            $table->string('cash');
            $table->string('bca');
            $table->string('mandiri');
            $table->string('qris');
            $table->string('ongkir');
            $table->string('refund');
            $table->string('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
