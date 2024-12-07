<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseOfficerTable extends Migration
{
    public function up()
    {
        Schema::create('license_officer', function (Blueprint $table) {
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('officer_id');
            $table->timestamps();

            $table->primary(['license_id', 'officer_id']);

            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('license_officer');
    }
}
