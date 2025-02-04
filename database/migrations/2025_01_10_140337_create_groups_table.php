<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Group name (e.g., Group 1)
            $table->unsignedBigInteger('supervisor_id')->nullable(); // Supervisor assigned to the group
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
