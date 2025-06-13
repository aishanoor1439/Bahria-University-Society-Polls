<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['position_id']);

            // Then drop the column
            $table->dropColumn('position_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            // Add the column back
            $table->unsignedBigInteger('position_id')->nullable();

            // Re-add the foreign key (assuming it references a `positions` or similar table)
            $table->foreign('position_id')->references('id')->on('positions_table')->onDelete('cascade');
        });
    }
};
