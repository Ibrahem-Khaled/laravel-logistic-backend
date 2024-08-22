<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('container_id')->unsigned();
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            $table->enum('type', ['aerial', 'ground', 'nautical'])->default('nautical');
            $table->enum('status',['pending', 'sent', 'delivered'])->default('pending');
            $table->string('tracking_number', 50)->unique();
            $table->string('sent_area');
            $table->string('delivered_area');
            $table->timestamp('sent_date')->nullable();
            $table->timestamp('delivered_date')->nullable();
            $table->integer('weight');
            $table->string('dimensions');
            $table->float('price')->default(0);
            $table->bigInteger('shipment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
