<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id('vote_id');
            $table->unsignedBigInteger('voter_id');
            $table->unsignedBigInteger('election_id');
            $table->unsignedBigInteger('candidate_id');
            $table->timestamp('vote_timestamp')->useCurrent();
            $table->timestamps();

            // Unique constraint on voter and election
            $table->unique(['voter_id', 'election_id'], 'votes_voter_id_election_id_unique');

            // Foreign keys
            $table->foreign('voter_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('election_id')->references('election_id')->on('elections')->onDelete('cascade');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates')->onDelete('cascade');
            $table->unique(['voter_id', 'election_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
