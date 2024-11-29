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
        Schema::create('ojt_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');  // Foreign key to ojt_students id
            $table->unsignedBigInteger('joblist_id');  // Foreign key to ojt_companies id
            $table->date('application_date');
            $table->integer('resume_mode'); // Value from 1 - 3
            $table->string('resume_file_id')->nullable(); // Foreign Key to downloadables which points to resume file
            $table->integer('cover_mode'); // Value from 1 - 3
            $table->string('cover_file_id')->nullable(); // Foreign Key to downloadables which points to cover letter file
            $table->text('cover_text')->nullable(); // Cover letter text

            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('ojt_students')->onDelete('cascade');
            $table->foreign('joblist_id')->references('id')->on('ojt_job_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_applicants');
    }
};
