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
        Schema::create('proposal_comments', function (Blueprint $table) {
            $table->id();
        $table->foreignId('proposal_id')->constrained()->onDelete('cascade'); // Relates to Proposal
        $table->foreignId('supervisor_id')->constrained('users')->onDelete('cascade'); // Relates to Supervisor (user)
        $table->text('comment'); // Supervisor's comment
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
        Schema::dropIfExists('proposal_comments');
    }
};
