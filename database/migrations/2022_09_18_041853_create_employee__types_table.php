<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__types', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('type_user');
            $table->text('sa')->nullable();
            $table->text('cshr')->nullable();
            $table->text('hos')->nullable();
            $table->text('how')->nullable();
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
        Schema::dropIfExists('employee__types');
    }
}
