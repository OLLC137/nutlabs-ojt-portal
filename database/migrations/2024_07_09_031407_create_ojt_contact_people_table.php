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
        Schema::create('ojt_contact_people', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('contact_name');
            $table->string('contact_position');
            $table->string('contact_contact');
            $table->string('contact_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_contact_people');
    }
};
