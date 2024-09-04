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
        Schema::table('ojt_requirements', function (Blueprint $table) {
            $table->timestamp('locked_at')->nullable()->after('req_file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ojt_requirements', function (Blueprint $table) {
            $table->dropColumn('locked_at');
        });
    }
};
