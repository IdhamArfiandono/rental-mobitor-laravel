<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('type', ['motor', 'mobil']);
            $table->smallInteger('year');
            $table->string('plate_number')->unique();
            $table->decimal('price_per_day', 10, 2);
            $table->string('fuel_type');
            $table->enum('transmission', ['manual', 'automatic']);
            $table->integer('capacity');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
