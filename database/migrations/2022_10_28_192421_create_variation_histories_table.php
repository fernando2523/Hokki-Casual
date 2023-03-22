<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_histories', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('id_history');
            $table->string('id_produk');
            $table->string('id_ware');
            $table->string('size');
            $table->string('qty');
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
        Schema::dropIfExists('variation_histories');
    }
}
