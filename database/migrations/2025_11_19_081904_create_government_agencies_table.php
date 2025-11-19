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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('NameAr');
            $table->string('NameEn');
            $table->text('DescriptionAr');
            $table->text('DescriptionEn');
            $table->string('LocationAr');
            $table->string('LocationEn');
            $table->time('WorkingStartTime');
            $table->time('WorkingEndTime');
            $table->boolean('Status')->default(true);
            $table->foreignId('ParentId')->nullable()->constrained('agencies');
            $table->foreignId('ManagerId')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agencies');
    }

};
