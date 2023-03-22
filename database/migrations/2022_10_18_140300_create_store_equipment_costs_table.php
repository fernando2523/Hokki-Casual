<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreEquipmentCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_equipment_costs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('id_costs');
            $table->string('store');
            $table->string('item');
            $table->string('desc')->nullable(true);
            $table->string('total_price');
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
        Schema::dropIfExists('store_equipment_costs');
    }
}
