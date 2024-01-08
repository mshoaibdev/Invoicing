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
            $table->json('items');
            $table->decimal('total', 10);
            $table->decimal('subtotal', 10);
            $table->decimal('discount_amount', 10)->nullable();
            $table->decimal('discount_percentage', 10)->nullable();
            $table->decimal('pay_amount', 10)->nullable();
            $table->decimal('due_amount', 10)->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('paid_date')->nullable();
            $table->tinyInteger('is_sent')->default(0);
            $table->tinyInteger('is_viewed')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('is_partial')->default(0);
            $table->string('status', 50)->nullable()->default('Draft');
            $table->json('payment_response')->nullable();
            $table->string('invoice_link')->nullable();
            $table->text('note')->nullable();
            $table->text('terms')->nullable();

            $table->foreignId('payment_method_id')->nullable()->constrained()->onDelete('restrict');
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
