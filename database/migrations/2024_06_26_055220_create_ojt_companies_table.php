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
        Schema::create('ojt_companies', function (Blueprint $table) {
            $table->id();
            $table->string('co_name');
            $table->string('co_address');
            $table->string('co_contact_number');
            $table->string('co_email')->unique();
            $table->string('co_website')->nullable();
            $table->boolean('co_isactive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_companies');
    }
};
