<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up()
    public function up()
    {
        Schema::table('student_societies', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable()->after('society_id');
            $table->foreign('position_id')->references('position_id')->on('positions')->onDelete('set null');
        });
    }

    // down()
    public function down()
    {
        Schema::table('student_societies', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropColumn('position_id');
        });
    }
};
