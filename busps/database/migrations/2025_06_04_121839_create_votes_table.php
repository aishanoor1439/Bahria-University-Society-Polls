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
        Schema::create('votes', function (Blueprint $table) {
            $table->id('vote_id');
            $table->unsignedBigInteger('voter_id');
            $table->unsignedBigInteger('election_id');
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('position_id');
            $table->timestamp('vote_timestamp')->useCurrent();
            $table->timestamps();

            $table->foreign('voter_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('election_id')->references('election_id')->on('elections')->onDelete('cascade');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates')->onDelete('cascade');
            $table->foreign('position_id')->references('position_id')->on('positions')->onDelete('cascade');

            $table->unique(['voter_id', 'election_id', 'position_id']); // One vote per position in an election
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
