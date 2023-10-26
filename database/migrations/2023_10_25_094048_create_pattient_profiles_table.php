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
        Schema::create('pattient_profiles', function (Blueprint $table) {
            $table->foreignId('pattient_id')->constrained('pattients')->cascadeOnDelete();
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

            $table->primary('pattient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pattient_profiles');
    }
};
