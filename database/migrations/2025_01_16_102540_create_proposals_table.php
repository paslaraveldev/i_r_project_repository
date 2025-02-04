<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('group_id'); 
            $table->unsignedBigInteger('concept_id'); 
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->string('pdf_path')->nullable(); 
            $table->timestamp('supervisor_commented_at')->nullable();

            $table->enum('status', ['Draft', 'Submitted', 'Needs Revision', 'Approved', 'Rejected'])->default('Draft'); // Status
            $table->unsignedBigInteger('submitted_by')->nullable(); 
            $table->unsignedBigInteger('reviewed_by')->nullable(); 
            $table->text('supervisor_comments')->nullable(); 
            $table->timestamps(); 

            // Foreign key constraints
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('concept_id')->references('id')->on('concepts')->onDelete('cascade');
            $table->foreign('submitted_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
};
