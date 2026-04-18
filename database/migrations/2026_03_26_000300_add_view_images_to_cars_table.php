<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->string('front_image_path')->nullable()->after('hero_image_path');
            $table->string('rear_image_path')->nullable()->after('front_image_path');
            $table->string('side_image_path')->nullable()->after('rear_image_path');
            $table->string('interior_image_path')->nullable()->after('side_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropColumn([
                'front_image_path',
                'rear_image_path',
                'side_image_path',
                'interior_image_path',
            ]);
        });
    }
};
