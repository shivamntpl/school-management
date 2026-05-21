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
        Schema::create('students', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('student_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('local_guardian_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('village');
            $table->string('post');
            $table->string('ps');
            $table->string('district');
            $table->string('pin', 6);
            $table->date('dob');
            $table->integer('age');
            $table->boolean('bpl')->default(false);
            $table->string('religion');
            $table->string('mother_tongue');
            $table->string('caste');
            $table->string('sex');
            $table->string('class');
            $table->string('disease')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('aadhaar_number', 12)->nullable();
            $table->string('vehicle_number')->nullable();
            $table->text('details')->nullable();
            $table->string('reg_no');
            $table->string('sr_no');
            $table->decimal('total_fees', 10, 2);
            $table->string('admission_type');
            $table->decimal('amount', 10, 2);
            $table->date('date_of_admission');
            $table->decimal('book_fees', 10, 2)->nullable();
            $table->boolean('age_wise')->default(false);
            $table->decimal('monthly', 10, 2)->nullable();
            $table->string('total_for_year')->nullable();
            $table->text('discount')->nullable();
            $table->decimal('after_discount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};