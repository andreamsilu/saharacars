<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->string('source_country', 80)->nullable()->after('location');
            $table->string('import_status', 40)->nullable()->after('condition');
            $table->date('eta_date')->nullable()->after('import_status');
            $table->unsignedBigInteger('landed_cost_tzs')->nullable()->after('price_tzs');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropColumn([
                'source_country',
                'import_status',
                'eta_date',
                'landed_cost_tzs',
            ]);
        });
    }
};

