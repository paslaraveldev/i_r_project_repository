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
    Schema::table('courses', function (Blueprint $table) {
        if (!Schema::hasColumn('courses', 'department_id')) {
            $table->foreignId('department_id')->after('name')->constrained('departments')->onDelete('cascade');
        }
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
