<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseOfficerTable extends Migration
{
    public function up()
    {
        Schema::create('license_officer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('officer_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('license_officer');
    }
}
