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
            $table->uuid('uuid');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->decimal('tax_amount', 10)->nullable();
            $table->integer('tax_percentage')->nullable()->default(0);
            // vat
            $table->integer('vat_percentage')->nullable()->default(0);
            $table->decimal('vat_amount', 10)->nullable();

            $table->json('items');
            $table->decimal('total', 10);
            $table->decimal('subtotal', 10);

            // due amount
            $table->decimal('due_amount', 10)->nullable();
            $table->decimal('paid_amount', 10)->nullable();
            $table->decimal('discount_amount', 10)->nullable();
            $table->decimal('discount_percentage', 10)->nullable();
            // remaining amount

            $table->tinyInteger('is_sent')->default(0);
            $table->tinyInteger('is_viewed')->default(0);
            $table->tinyInteger('is_paid')->default(0);

            $table->string('status', 50)->nullable()->default('Paid');
            $table->string('payment_method', 50);
            $table->json('payment_response')->nullable();
            $table->string('invoice_link')->nullable();
            $table->text('note')->nullable();

            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->foreignId('company_id')->constrained()->onDelete('restrict');
            $table->foreignId('creator_id')->constrained('users')->onDelete('restrict');

            $table->timestamps();
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