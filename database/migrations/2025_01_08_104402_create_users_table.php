<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
             $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('image')->nullable(); // User's profile picture
            $table->string('password')->nullable();

            $table->enum('role', ['student', 'supervisor', 'project_coordinator', 'admin']);
            $table->string('registration_number')->nullable()->unique(); // Only for students
            $table->string('job_id_number')->nullable()->unique(); // Only for supervisors/project coordinators
            $table->year('year_of_entry')->nullable(); // Only for students
            $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete(); // Only for students
           // For supervisors/project coordinators
            $table->timestamp('email_verified_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
