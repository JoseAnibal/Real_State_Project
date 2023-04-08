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
        Schema::create('incidences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained('rentals');
            $table->date('date');
            $table->integer('status');
            $table->string('title',50);
            $table->string('description',150);
            $table->string('image_url')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidences');
    }
};
