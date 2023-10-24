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
        Schema::create('homer_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('outing_id');
            $table->string('name');
            $table->string('path');
            $table->string('mimeType');
            $table->bigInteger('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homer_images');
    }
};
