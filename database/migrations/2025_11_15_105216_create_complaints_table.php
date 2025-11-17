<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->string('reference_no')->unique();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('complaint_type');
        $table->unsignedBigInteger('agency_id');
        $table->unsignedBigInteger('reporter_id');
        $table->unsignedBigInteger('current_status_id');
        $table->text('location')->nullable();
        $table->timestamps();
        $table->timestamp('closed_at')->nullable();


        $table->foreign('agency_id')->references('id')->on('agencies');
        $table->foreign('reporter_id')->references('id')->on('users');
        $table->foreign('current_status_id')->references('id')->on('complaint_statuses');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
