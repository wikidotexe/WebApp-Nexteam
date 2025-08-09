<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained()->cascadeOnDelete();
                $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
                $table->string('invoice_number')->unique();
                $table->date('invoice_date');
                $table->date('due_date')->nullable();
                $table->decimal('sub_total', 12, 2)->default(0);
                $table->decimal('tax', 12, 2)->default(0);
                $table->decimal('total', 12, 2)->default(0);
                $table->enum('status', ['unpaid','paid','partial','overdue'])->default('unpaid');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        } elseif (!Schema::hasColumn('invoices', 'invoice_number')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->string('invoice_number')->unique()->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
