<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('installments');
            $table->unsignedInteger('contract');
            $table->date('date_transfer');
            $table->decimal('rent_price', 10, 2);
            $table->decimal('adm_fee', 10, 2);
            $table->decimal('tribute', 10, 2);
            $table->decimal('transfer', 10, 2);
            $table->timestamps();

            $table->foreign('contract')->references('id')->on('contracts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
