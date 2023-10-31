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
        Schema::create('fund_accounts', function (Blueprint $table) {
            //صندوق
            $table->id();
            $table->foreignId('pattient_id')->nullable()->constrained('pattients')->nullOnDelete();
            $table->foreignId('single_invoice_id')->nullable()->constrained('single_invoices')->nullOnDelete();
            $table->foreignId('receipt_account_id')->nullable()->constrained('receipt_accounts')->nullOnDelete();
            $table->float('receive')->default(0);  //استلم الصندوق فلوس
            $table->float('taking')->default(0);   //اخذ من الصندوق فلوس
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_accounts');
    }
};
