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
        Schema::create('complaint_responses', function (Blueprint $table) {
            $table->id();
            $table->text('Response');
            $table->foreignId('EmployeeId')->constrained('agency_employees');
            $table->foreignId('UserId')->constrained('users');
            $table->foreignId('ComplaintId')->constrained('complaints');
            $table->foreignId('ParentId')->nullable()->constrained('complaint_responses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaint_responses');
    }
};
