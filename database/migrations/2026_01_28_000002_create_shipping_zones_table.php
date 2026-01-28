<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('code', 10); // Z1..Z6
            $table->string('name')->nullable();
            $table->timestamps();

            $table->unique(['origin_country_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_zones');
    }
};

