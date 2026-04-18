<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->json('front_image_paths')->nullable()->after('front_image_path');
            $table->json('rear_image_paths')->nullable()->after('rear_image_path');
            $table->json('side_image_paths')->nullable()->after('side_image_path');
            $table->json('interior_image_paths')->nullable()->after('interior_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropColumn([
                'front_image_paths',
                'rear_image_paths',
                'side_image_paths',
                'interior_image_paths',
            ]);
        });
    }
};
