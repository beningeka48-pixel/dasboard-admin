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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('birth-place');
            $table->date('birth-date')->nullable();
            $table->text('address');
            $table->string('phone-number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital-status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
