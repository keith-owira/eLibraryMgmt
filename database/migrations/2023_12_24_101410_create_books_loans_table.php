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
        Schema::create('books_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->date('loan_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('extended', 3)->nullable();
            $table->date('extension_date')->nullable();
            $table->integer('penalty_amount')->nullable();
            $table->string('penalty_status', 15)->nullable();
            $table->string('status', 20)->default('pendingApproval')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->timestamps();
        });

        // Set the default timestamp for loan_date after table creation
        DB::statement('ALTER TABLE books_loans MODIFY COLUMN loan_date DATE DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_loans');
    }
};
