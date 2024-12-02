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
        Schema::table('ads_banners', function (Blueprint $table) {
            //
            $table->string('link');
            $table->string('type');
            $table->string('thumbnail');
            $table->enum('is_active', ['active', 'not_active'])->default('not_active');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads_banners', function (Blueprint $table) {
            //
            $table->dropColumn(['link', 'type', 'thumbnail', 'is_active']);
        });
    }
};
