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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('title',100)->unique();
            $table->string('description');
            $table->string('adress');
            $table->integer('m2');
            $table->integer('type');
            $table->integer('rooms')->nullable();
            $table->integer('baths')->nullable();
            $table->double('price');
            $table->string('coordinates');
            $table->integer('status');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
