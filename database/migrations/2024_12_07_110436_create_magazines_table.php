<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('caliber'); // caliber
            $table->integer('capacity'); // capacity
            $table->unsignedBigInteger('model_id'); // model_id (FK)
            $table->string('model_magazine'); // model_magazine
            $table->boolean('in_stock'); // in_stock
            $table->timestamps(); // updated_at

            // Foreign key constraint
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazines');
    }
}
