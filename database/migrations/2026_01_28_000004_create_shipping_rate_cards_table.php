<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_rate_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_country_id')->constrained('countries')->cascadeOnDelete();
            $table->enum('shipment_type', ['documents', 'parcel'])->index();
            $table->string('name')->nullable();
            $table->string('currency', 3)->default('JOD');
            $table->boolean('is_active')->default(true)->index();
            $table->date('valid_from')->nullable()->index();
            $table->date('valid_to')->nullable()->index();
            $table->timestamps();

            $table->index(['origin_country_id', 'shipment_type', 'is_active'], 'shipping_rate_cards_lookup');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_rate_cards');
    }
};

