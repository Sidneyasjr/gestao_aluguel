<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('installments');
            $table->unsignedInteger('contract');
            $table->date('due_date');
            $table->decimal('rent_price', 10, 2);
            $table->decimal('tribute', 10, 2);
            $table->decimal('condominium', 10, 2);
            $table->decimal('payment', 10, 2);
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
        Schema::dropIfExists('monthly_payments');
    }
}
