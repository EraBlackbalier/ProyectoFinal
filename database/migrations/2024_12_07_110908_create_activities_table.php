<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->unsignedBigInteger('officer_id'); // officer_id (FK)
            $table->unsignedBigInteger('weapon_id'); // weapon_id (FK)
            $table->unsignedBigInteger('magazine_id'); // magazine_id (FK)
            $table->unsignedBigInteger('branch_id'); // branch_id (FK)
            $table->date('date'); // date
            $table->text('reason'); // reason
            $table->timestamps(); // updated_at

            // Foreign key constraints
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
            $table->foreign('weapon_id')->references('id')->on('weapons')->onDelete('cascade');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
