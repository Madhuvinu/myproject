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
        Schema::dropIfExists('about_us_images');
        Schema::create('about_us_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_id')->constrained('about_us')->onDelete('cascade');
            $table->string('image_path');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_images');
    }
};
