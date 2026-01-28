<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_zone_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('destination_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('shipping_zone_id')->constrained('shipping_zones')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['origin_country_id', 'destination_country_id'], 'shipping_zone_origin_destination_unique');
            $table->index(['origin_country_id', 'shipping_zone_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_zone_countries');
    }
};

