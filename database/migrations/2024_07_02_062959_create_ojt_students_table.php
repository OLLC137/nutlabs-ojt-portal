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
        Schema::create('ojt_students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('stud_prefix')->nullable();
            $table->string('stud_first_name');
            $table->string('stud_middle_initial');
            $table->string('stud_last_name');
            $table->string('stud_suffix')->nullable();
            $table->string('stud_sex');
            $table->date('stud_birthday');
            $table->string('stud_birth_place');
            $table->string('stud_student_telephone', 20);
            $table->string('stud_email');
            $table->string('stud_junior_high_school');
            $table->string('stud_senior_high_school');
            $table->string('stud_university');
            $table->string('stud_sr_code');
            $table->string('stud_department');
            $table->string('stud_expected_graduation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_students');
    }
};
