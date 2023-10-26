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
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->char('locale')->default('en');
            $table->char('timezone')->nullable();
            $table->string('job_name')->nullable();
            $table->string('specialization')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->primary('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};
