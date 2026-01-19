<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePositionIdFromCandidatesTable extends Migration
{
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropForeign(['position_id']); // only if you had a foreign key
            $table->dropColumn('position_id');
        });
    }

    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable();
            // If it had a foreign key before, re-add:
            $table->foreign('position_id')->references('position_id')->on('positions')->onDelete('cascade');
        });
    }
}
