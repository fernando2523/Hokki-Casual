<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_variations', function (Blueprint $table) {
            $table->id();
            $table->string('idpo');
            $table->string('id_sup');
            $table->string('id_produk');
            $table->string('id_area');
            $table->string('id_ware');
            $table->string('tanggal');
            $table->string('size');
            $table->string('qty');
            $table->string('tipe_order');
            $table->string('id_act');
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
        Schema::dropIfExists('supplier_variations');
    }
}
