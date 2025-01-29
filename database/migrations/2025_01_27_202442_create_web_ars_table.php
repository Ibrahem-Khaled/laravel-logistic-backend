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
        Schema::create('web_ars', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_image')->nullable();
            $table->text('keywords')->nullable();

            $table->text(column: 'hero_title')->nullable();
            $table->text(column: 'hero_description')->nullable();
            $table->text(column: 'hero_image')->nullable();

            $table->text(column: 'about_title')->nullable();
            $table->text(column: 'about_description')->nullable();
            $table->text(column: 'about_image')->nullable();
            $table->json(column: 'about_features')->nullable();

            $table->text(column: 'location_title')->nullable();
            $table->text(column: 'location_description')->nullable();
            $table->text(column: 'location_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_ars');
    }
};
