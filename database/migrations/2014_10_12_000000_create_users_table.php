<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36)->unique()->primary();
            $table->string('first_name', 255)->index();
            $table->string('last_name', 255)->index();
            $table->boolean('is_admin')->default(0);
            $table->string('email', 255)->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->char('avatar', 36)->nullable(); //UUID of image stored in files table
            $table->string('address', 255);
            $table->string('phone_number', 255);
            $table->boolean('is_marketing')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
