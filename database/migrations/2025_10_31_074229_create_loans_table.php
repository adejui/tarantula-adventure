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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('opa_id')
                ->nullable()
                ->constrained('opas')
                ->onDelete('cascade');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->enum('status', ['requested', 'approved', 'borrowed', 'returned', 'rejected', 'late'])->default('requested');
            $table->text('notes')->nullable();
            $table->string('loan_document')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
