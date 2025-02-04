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
         Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('concept_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_type_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable(); // Report description
            $table->string('image')->nullable(); // Optional image path
            $table->text('abstract');
            $table->string('video_link')->nullable(); // Optional video link
            $table->string('pdf_file'); // PDF file path
            $table->enum('status', ['Draft', 'Ready for Submission'])->default('Draft'); // Status
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null'); 

            $table->text('supervisor_comments')->nullable();
            $table->timestamp('supervisor_commented_at')->nullable();
            $table->boolean('revision_needed')->default(false);
            $table->enum('confidentiality_level', ['Public', 'Restricted', 'Confidential'])->default('Public');

            $table->timestamp('submission_date')->useCurrent();
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
        Schema::dropIfExists('reports');
    }
};
