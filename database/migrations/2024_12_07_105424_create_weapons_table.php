<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->id(); // code (primary key)
            $table->string('model'); // model
            $table->unsignedBigInteger('wtype_id'); // wtype_id (foreign key)
            $table->boolean('status'); // status
            $table->timestamp('created_at')->useCurrent(); // created_at
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // updated_at

            // Foreign key constraint
            $table->foreign('wtype_id')->references('id')->on('weapon_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weapons');
    }
}
