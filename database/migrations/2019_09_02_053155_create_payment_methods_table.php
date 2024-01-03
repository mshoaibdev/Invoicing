<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        if (! Schema::hasTable('payment_methods')) {
            Schema::create('payment_methods', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->boolean('is_default')->default(false);
                $table->boolean('is_gateway')->default(false);
                $table->boolean('is_enabled')->default(false);
                $table->string('live_identifier')->nullable();
                $table->string('live_secret')->nullable();
                $table->string('sandbox_identifier')->nullable();
                $table->string('sandbox_secret')->nullable();
                $table->string('mode')->default('sandbox');
                $table->foreignId('company_id')->constrained('companies')->onDelete('restrict');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
