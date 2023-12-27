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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('title');
            $table->string('contact_info');
            $table->string('price');
            $table->string('type');
            $table->string('time');
            $table->date('added_date');
            $table->date('last_worked_on')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Initiated');
            $table->foreignId('user_id');
            $table->foreignId('created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
