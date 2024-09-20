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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->default(1)->comment('0=Super Admin, 1=Admin, 2=OJT Head, 3=OJT Coordinator, 20= Student, 4=Company User')->change();

        });
    }

};
