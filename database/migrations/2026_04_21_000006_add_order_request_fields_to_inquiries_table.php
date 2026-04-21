<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table): void {
            $table->string('inquiry_type', 40)->default('contact')->after('message');
            $table->string('phone', 40)->nullable()->after('email');
            $table->string('preferred_brand', 80)->nullable()->after('inquiry_type');
            $table->string('preferred_model', 120)->nullable()->after('preferred_brand');
            $table->unsignedSmallInteger('year_min')->nullable()->after('preferred_model');
            $table->unsignedSmallInteger('year_max')->nullable()->after('year_min');
            $table->unsignedBigInteger('budget_min_tzs')->nullable()->after('year_max');
            $table->unsignedBigInteger('budget_max_tzs')->nullable()->after('budget_min_tzs');
            $table->string('source_country', 80)->nullable()->after('budget_max_tzs');
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table): void {
            $table->dropColumn([
                'inquiry_type',
                'phone',
                'preferred_brand',
                'preferred_model',
                'year_min',
                'year_max',
                'budget_min_tzs',
                'budget_max_tzs',
                'source_country',
            ]);
        });
    }
};

