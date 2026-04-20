<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 80)->unique();
            $table->string('slug', 100)->unique();
            $table->string('logo_url', 500)->nullable();
            $table->boolean('is_featured')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('cars', function (Blueprint $table): void {
            $table->foreignId('brand_id')
                ->nullable()
                ->after('brand')
                ->constrained('brands')
                ->nullOnDelete();
        });

        $rawBrands = DB::table('cars')
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->select('brand')
            ->distinct()
            ->pluck('brand');

        $brandIdByName = [];
        $sort = 1;
        foreach ($rawBrands as $rawName) {
            $name = trim((string) $rawName);
            if ($name === '') {
                continue;
            }

            $slugBase = Str::slug($name);
            $slug = $slugBase !== '' ? $slugBase : Str::random(8);
            $index = 2;
            while (DB::table('brands')->where('slug', $slug)->exists()) {
                $slug = $slugBase.'-'.$index;
                $index++;
            }

            $brandId = DB::table('brands')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'is_featured' => true,
                'sort_order' => $sort,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $brandIdByName[$name] = $brandId;
            $sort++;
        }

        foreach ($brandIdByName as $name => $brandId) {
            DB::table('cars')
                ->where('brand', $name)
                ->update(['brand_id' => $brandId]);
        }
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('brand_id');
        });

        Schema::dropIfExists('brands');
    }
};

