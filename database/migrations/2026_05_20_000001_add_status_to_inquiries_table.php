<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table): void {
            $table->string('status', 20)->default('pending')->after('inquiry_type');
        });

        DB::table('inquiries')
            ->where('inquiry_type', 'order_request')
            ->whereNotNull('read_at')
            ->update(['status' => 'done']);

        DB::table('inquiries')
            ->where('inquiry_type', 'order_request')
            ->whereNull('read_at')
            ->update(['status' => 'pending']);
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table): void {
            $table->dropColumn('status');
        });
    }
};
