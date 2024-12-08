<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // name
            $table->unsignedBigInteger('id_branch'); // id_branch (FK)
            $table->unsignedBigInteger('id_shift'); // id_shift (FK)
            $table->unsignedBigInteger('division_id'); // division_id (FK)
            $table->date('join_date'); // join_date
            $table->string('email'); // email
            $table->bigInteger('phone'); // phone
            $table->string('curp')->unique(); // curp
            $table->date('birthday'); // birthday
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('id_branch')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('id_shift')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officers');
    }
}
