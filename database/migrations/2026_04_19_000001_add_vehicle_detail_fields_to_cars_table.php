<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('model', 120)->nullable()->after('brand');
            $table->string('body_color', 120)->nullable()->after('model');
            $table->string('body_type', 80)->nullable()->after('body_color');
            $table->unsignedTinyInteger('doors')->nullable()->after('body_type');
            $table->unsignedTinyInteger('seats')->nullable()->after('doors');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['model', 'body_color', 'body_type', 'doors', 'seats']);
        });
    }
};
