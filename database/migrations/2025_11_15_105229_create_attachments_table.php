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
        Schema::create('attachments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('complaint_id');
        $table->unsignedBigInteger('uploaded_by');
        $table->text('file_path');
        $table->string('file_type');
        $table->bigInteger('file_size');
        $table->timestamp('created_at')->useCurrent();


        $table->foreign('complaint_id')->references('id')->on('complaints');
        $table->foreign('uploaded_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
