<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employment_types', function (Blueprint $table) {
            $table->id();
            $table->string('NameAr');
            $table->string('NameEn');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_types');
    }
};
