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
        Schema::create('receipt_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pattient_id')->nullable()->constrained('pattients')->nullOnDelete();
            $table->float('amount')->default(0);
            $table->enum('type',['pay','receipt']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_accounts');
    }
};
