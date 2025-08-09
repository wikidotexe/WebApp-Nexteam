<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained()->cascadeOnDelete();
                $table->string('title');
                $table->text('description')->nullable();
                $table->decimal('rate', 12, 2)->nullable(); // tarif per hour atau fixed
                $table->enum('billing_type', ['fixed', 'hourly'])->default('fixed');
                $table->decimal('amount', 12, 2)->nullable();
                $table->enum('status', ['active', 'done', 'ongoing'])->default('active');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->date('due_date')->nullable();
                $table->timestamps();
            });
        }
    }

};
