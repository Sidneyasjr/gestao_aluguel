<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property');
            $table->unsignedInteger('owner');
            $table->unsignedInteger('customer');
            $table->decimal('rent_price', 10, 2)->nullable()->default(0);
            $table->decimal('adm_fee', 10, 2)->nullable()->default(0);
            $table->decimal('tribute', 10, 2)->nullable()->default(0);
            $table->decimal('condominium', 10, 2)->nullable()->default(0);
            $table->date('start_at');
            $table->date('end_at');
            $table->timestamps();

            $table->foreign('property')->references('id')->on('properties')->onDelete('CASCADE');
            $table->foreign('owner')->references('id')->on('owners')->onDelete('CASCADE');
            $table->foreign('customer')->references('id')->on('customers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
