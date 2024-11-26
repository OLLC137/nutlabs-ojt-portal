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
        Schema::create('journal_edit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('ojt_students')->onDelete('cascade');
            $table->date('requested_date');
            $table->string('reason', 255);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('journal_edit_requests');
    }
};
