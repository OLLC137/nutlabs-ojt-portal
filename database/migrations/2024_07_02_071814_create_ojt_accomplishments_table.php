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
        Schema::create('ojt_accomplishments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('acc_date');
            $table->string('acc_accomplishments');
            $table->string('acc_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_accomplishments');
    }
};
