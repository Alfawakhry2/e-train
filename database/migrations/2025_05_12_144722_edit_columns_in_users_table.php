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
            //edit phone and address make them are nullable
            $table->text('phone')->nullable()->change();
            $table->text('address')->nullable()->change();

            //edit role make default is studen
            $table->enum('role', ['admin', 'student', 'trainer'])->default('student')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->change();
            $table->text('address')->change();
            $table->enum('role', ['admin', 'student', 'trainer'])->change();
        });
    }
};
