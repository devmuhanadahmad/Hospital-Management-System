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
        Schema::create('single_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pattients_id')->nullable()->constrained('pattients')->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->double('total_with_tax')->default(0);
            $table->enum('type',['cash','noCash']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_invoices');
    }
};
