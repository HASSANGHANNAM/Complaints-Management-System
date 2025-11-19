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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->text('Content');
            $table->foreignId('EmployeeId')->nullable()->constrained('users');
            $table->foreignId('UserId')->constrained('users');
            $table->foreignId('AgencyId')->constrained('agencies');
            $table->foreignId('SectionId')->constrained('agency_sections');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
