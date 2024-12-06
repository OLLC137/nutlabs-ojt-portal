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
        Schema::create('ojt_requirements', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('req_id');
            $table->string('req_file_name');
            $table->string('req_orig_name');
            $table->string('req_file_path');
            $table->string('req_file_url');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_requirements');
    }
};
