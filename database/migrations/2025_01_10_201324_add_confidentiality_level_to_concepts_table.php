<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('concepts', function (Blueprint $table) {
        $table->enum('confidentiality_level', ['Public', 'Restricted', 'Confidential'])
            ->default('Public');
    });
}

public function down()
{
    Schema::table('concepts', function (Blueprint $table) {
        $table->dropColumn('confidentiality_level');
    });
}


};
