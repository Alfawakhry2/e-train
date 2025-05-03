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
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->enum('status' , ['pending' , 'active' , 'complete' , 'dropped'])->default('pending');
            $table->enum('course_status' , ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->enum('course_location' , ['online' , 'offline']);
            $table->softDeletes();
            $table->timestamps();
            
            $table->unique(['course_id' , 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_student');
    }
};
