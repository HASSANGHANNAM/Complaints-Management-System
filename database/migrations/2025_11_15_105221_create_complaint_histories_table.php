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
        Schema::create('complaint_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('complaint_id');
        $table->unsignedBigInteger('from_status_id')->nullable();
        $table->unsignedBigInteger('to_status_id');
        $table->text('comment')->nullable();
        $table->unsignedBigInteger('changed_by');
        $table->timestamp('created_at')->useCurrent();


        $table->foreign('complaint_id')->references('id')->on('complaints');
        $table->foreign('from_status_id')->references('id')->on('complaint_statuses');
        $table->foreign('to_status_id')->references('id')->on('complaint_statuses');
        $table->foreign('changed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_histories');
    }
};
