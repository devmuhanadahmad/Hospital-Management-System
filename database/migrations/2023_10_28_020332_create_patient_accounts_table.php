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
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pattient_id')->nullable()->constrained('pattients')->nullOnDelete();
            $table->foreignId('single_invoice_id')->nullable()->constrained('single_invoices')->nullOnDelete();
            $table->foreignId('receipt_account_id')->nullable()->constrained('receipt_accounts')->nullOnDelete();
            $table->float('debit')->default(0); //المريض مدين لنا بهذه الفلوس
            $table->float('credit')->default(0);//المريض دائن لنا بهذه الفلوس
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
