<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_act');
            $table->string('idpo');
            $table->string('id_sup');
            $table->string('id_produk');
            $table->string('id_area');
            $table->string('id_ware');
            $table->string('brand');
            $table->string('tanggal');
            $table->string('produk');
            $table->string('size');
            $table->string('desc')->nullable(true);
            $table->string('category');
            $table->string('quality');
            $table->string('n_price')->nullable(true);
            $table->string('m_price')->nullable(true);
            $table->string('qty');
            $table->string('subtotal');
            $table->string('payment_status');
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
        Schema::dropIfExists('product_piutangs');
    }
}
