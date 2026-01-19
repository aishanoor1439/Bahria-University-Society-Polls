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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('name'); // name VARCHAR(255) NOT NULL
            $table->string('email')->unique(); // email VARCHAR(255) UNIQUE NOT NULL
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // password VARCHAR(255) NOT NULL (required for auth)
            $table->string('picture')->nullable(); // picture VARCHAR(255) DEFAULT NULL
            $table->text('bio')->nullable(); // bio TEXT DEFAULT NULL
            $table->string('role'); // role VARCHAR(255) NOT NULL
            $table->string('phonenumber', 20)->nullable(); // phonenumber VARCHAR(20) DEFAULT NULL
            $table->rememberToken();
            $table->timestamps(); // created_at & updated_at with correct behavior
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
