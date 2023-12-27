<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->decimal('tax_amount', 10)->nullable();
            $table->integer('tax_percentage')->nullable()->default(0);
            $table->json('items');
            $table->decimal('total', 10);
            $table->decimal('subtotal', 10);
            $table->string('uuid');
            $table->bigInteger('user_id');
            $table->bigInteger('customer_id');
            $table->string('status', 50)->nullable()->default('Paid');
            $table->string('payment_method', 50);
            $table->json('payment_response')->nullable();
            $table->string('invoice_link')->nullable();
        
            $table->text('note')->nullable();
            $table->string('currency', 10)->default('USD');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE invoices AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
