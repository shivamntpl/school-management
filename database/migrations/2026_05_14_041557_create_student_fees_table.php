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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');

            $table->string('session');
            $table->enum('fee_type', [
                'Session Fees',
                'Book Fees',
                'Dress Fees'
            ]);
            $table->decimal('amount', 10, 2);
            $table->date('fee_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
