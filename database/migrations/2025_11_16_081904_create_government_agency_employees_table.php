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
        Schema::create('agency_employees', function (Blueprint $table) {
            $table->id();
            $table->boolean('EmploymentStatus')->default(true);
            $table->date('EmploymentDate');
            $table->boolean('CanResponseToComplaint')->default(false);
            $table->boolean('CanChangeComplaintStatus')->default(false);
            $table->foreignId('UserId')->constrained('users');
            $table->unsignedBigInteger('SectionId');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agency_employees');
    }
};
