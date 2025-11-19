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
        Schema::create('agency_sections', function (Blueprint $table) {
            $table->id();
            $table->string('NameAr');
            $table->string('NameEn');
            $table->text('DescriptionAr');
            $table->text('DescriptionEn');
            $table->foreignId('AgencyId')->constrained('agencies');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agency_sections');
    }
};
