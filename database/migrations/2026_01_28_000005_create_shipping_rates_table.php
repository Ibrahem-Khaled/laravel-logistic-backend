<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_rate_card_id')->constrained('shipping_rate_cards')->cascadeOnDelete();
            $table->foreignId('shipping_zone_id')->constrained('shipping_zones')->cascadeOnDelete();
            $table->enum('pricing_type', ['flat', 'per_kg'])->index();
            $table->decimal('weight_from_kg', 8, 2)->nullable()->index();
            $table->decimal('weight_to_kg', 8, 2)->nullable()->index();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('price_per_kg', 10, 2)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();

            $table->index(
                ['shipping_rate_card_id', 'shipping_zone_id', 'pricing_type'],
                'shipping_rates_ratecard_zone_type'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};

