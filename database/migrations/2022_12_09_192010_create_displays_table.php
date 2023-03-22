<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('id_produk');
            $table->string('idpo');
            $table->string('id_area');
            $table->string('id_ware');
            $table->string('id_store');
            $table->string('brand');
            $table->string('produk');
            $table->string('size')->nullable(true);
            $table->string('qty')->nullable(true);
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
        Schema::dropIfExists('displays');
    }
}
