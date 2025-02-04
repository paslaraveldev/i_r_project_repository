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
        Schema::create('concepts', function (Blueprint $table) {
              $table->id();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade'); // Reference group by ID
            $table->string('title');
            $table->text('main_objective');
            $table->text('other_objectives')->nullable();
            $table->text('description');
            $table->text('significance');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->text('rejection_reason')->nullable();
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
        Schema::dropIfExists('concepts');
    }
};
