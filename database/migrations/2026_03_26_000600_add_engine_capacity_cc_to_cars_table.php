<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->unsignedInteger('engine_capacity_cc')->nullable()->after('engine')->index();
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropColumn('engine_capacity_cc');
        });
    }
};
