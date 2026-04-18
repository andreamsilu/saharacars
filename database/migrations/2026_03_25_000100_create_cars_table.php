<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedInteger('year')->nullable();
            $table->string('location')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel')->nullable();
            $table->unsignedInteger('mileage_km')->nullable();
            $table->string('engine')->nullable();
            $table->unsignedBigInteger('price_tzs')->nullable();

            $table->text('description')->nullable();

            $table->string('hero_image_path')->nullable();
            $table->json('gallery_image_paths')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

