<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('destination');
            $table->string('duration');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('featured_image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('inclusions')->nullable();
            $table->longText('exclusions')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
