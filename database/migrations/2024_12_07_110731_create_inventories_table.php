<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->unsignedBigInteger('weapon_id'); // weapon_id (FK)
            $table->unsignedBigInteger('magazine_id'); // magazine_id (FK)
            $table->unsignedBigInteger('officer_id'); // officer_id (FK) to specify who owns the inventory
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('weapon_id')->references('id')->on('weapons')->onDelete('cascade');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
