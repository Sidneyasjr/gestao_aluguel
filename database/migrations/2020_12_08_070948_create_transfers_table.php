<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('enrollment');
            $table->unsignedInteger('contract');
            $table->unsignedInteger('owner');
            $table->decimal('value', 10, 2);
            $table->date('due_at');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('contract')->references('id')->on('contracts')->onDelete('CASCADE');
            $table->foreign('owner')->references('id')->on('owners')->onDelete('CASCADE');
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
