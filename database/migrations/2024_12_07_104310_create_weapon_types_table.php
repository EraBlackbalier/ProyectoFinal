<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_types', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('category'); // category
            $table->text('description')->nullable(); // description
            $table->timestamp('created_at')->useCurrent(); // created_at
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weapon_types');
    }
}
